<?php

namespace App\Http\Controllers\LPD1;

use App\Buyer;
use App\Http\Controllers\Controller;
use App\ProformaInvoice;
use App\ProformaInvoiceDetail;
use App\ProformaInvoiceMaster;
use App\PurchaseOrderDetail;
use App\PurchaseOrderMaster;
use App\TrimsType;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class ProformaInvoiceController extends Controller
{
    public function index(){
        $proformaInvoices = ProformaInvoiceMaster::orderBy('id', 'DESC')->where('status', '!=', 'D')->get();
        return view('lpd1.proforma-invoice.index', compact('proformaInvoices'));

    }

    public function poList(){

        $purchaseOrders= DB::table('purchase_order_masters')->orderBy('lpd_po_no', 'DESC')
            ->where('status', '!=', 'D')
//            ->where('pi_generation_activated', true)
            ->where('lpd', 1)
            ->take(1500)
            ->get();

        //return $purchaseOrderMaster;
        return view('lpd1.proforma-invoice.po-list', compact('purchaseOrders'));
    }

    public function poPIList($masterID){

        $purchaseOrder = PurchaseOrderMaster::find($masterID);
        if($purchaseOrder->lpd == 1){
            if($purchaseOrder == null){
                return redirect()->route('lpd1.proforma-invoice.po-list');
            }
            else if($purchaseOrder->status == 'D'){
                return redirect()->route('lpd1.proforma-invoice.po-list');
            }
            else if($purchaseOrder->status == 'CP'){
                return redirect()->route('lpd1.proforma-invoice.po-list');
            }
            else{
                $uniqTrimsTypes = DB::table('purchase_order_details')
                    ->join('trims_types', 'purchase_order_details.trims_type_id', '=', 'trims_types.id')
                    ->select('trims_types.short_name', 'trims_types.name')
                    ->where('purchase_order_details.purchase_order_master_id', $masterID)
                    ->orderBy('trims_types.name')
                    ->groupBy('purchase_order_details.trims_type_id', 'trims_types.short_name', 'trims_types.name')
                    ->get();

                $followPIApplicable = false;
                $newSinglePIApplicable = false;

                $orderQty =  DB::table('purchase_order_details')->select(DB::raw('sum(total_price_in_usd) as total_items'))
                    ->where('status', '!=', 'D')
                    ->where('purchase_order_master_id', $masterID)
                    ->first();

                //return $orderQty;

                $purchaseOrderDetails = PurchaseOrderDetail::orderBy('item_count')
                    ->where('status','!=', 'D')
                    ->where('purchase_order_master_id', $masterID)
                    ->get();

                $proformaInvoices = ProformaInvoiceMaster::orderBy('id', 'DESC')
                    ->where('status', '!=', 'D')
                    ->where('purchase_order_master_id', $masterID)
                    ->get();

                //return $proformaInvoices;

                if($proformaInvoices == null){
                    $followPIApplicable = true;
                    $newSinglePIApplicable = true;
                }
                else{
                    if($proformaInvoices->count() == 1) {
                        if ($proformaInvoices[0]->is_follow_pi == true) {
                            $followPIApplicable = true;
                            $newSinglePIApplicable = false;
                        }
                        else{
                            $followPIApplicable = false;
                            $newSinglePIApplicable = false;
                        }
                    }
                    else if ($proformaInvoices->count() == 0){
                        $followPIApplicable = true;
                        $newSinglePIApplicable = true;
                    }
                    else{
                        $followPIApplicable = true;
                        $newSinglePIApplicable = false;
                    }
                }
                return view('lpd1.proforma-invoice.active-po-pi-list',
                    compact('proformaInvoices', 'purchaseOrder', 'uniqTrimsTypes',
                        'followPIApplicable', 'newSinglePIApplicable', 'orderQty', 'purchaseOrderDetails'));

            } // other data
        }
        else{
            return redirect()->route('lpd1.proforma-invoice.po-list');
        }

    }


    public function saveNewSinglePI(Request $request){
        $purchaseOrderMaster = PurchaseOrderMaster::find($request->purchase_order_master_id);

        $purchaseOrderDetails = PurchaseOrderDetail::orderBy('item_count')
            ->where('status','!=', 'D')
            ->where('purchase_order_master_id', $request->purchase_order_master_id)
            ->get();

        if($purchaseOrderDetails->count() > 0){

            $proformaInvoiceMaster = new ProformaInvoiceMaster();
            $ger_date = new Carbon($request->pi_date);
            $proformaInvoiceMaster->job_year = $ger_date->year;

            $lastProformaInvoiceMaster = ProformaInvoiceMaster::orderBy('job_no', 'DESC')
                ->where('status', '!=', 'D')
                ->where('lpd', 1)
                ->where('job_year', $ger_date->year)
                ->first();

            if($lastProformaInvoiceMaster == null){
                $proformaInvoiceMaster->job_no = 1;
            }
            else if($lastProformaInvoiceMaster->count() <= 0){
                $proformaInvoiceMaster->job_no = 1;
            }
            else{
                $proformaInvoiceMaster->job_no = $lastProformaInvoiceMaster->job_no + 1;
            }

            $proformaInvoiceMaster->lpd = $purchaseOrderMaster->lpd;
            $proformaInvoiceMaster->job_year = $ger_date->year;
            $proformaInvoiceMaster->purchase_order_master_id = $request->purchase_order_master_id;

            if($purchaseOrderMaster->revise_count > 0){
                $proformaInvoiceMaster->is_revise = true;
            }
            else{
                $proformaInvoiceMaster->is_revise = false;
            }

            $proformaInvoiceMaster->pi_revise_count = $purchaseOrderMaster->revise_count;
            if($purchaseOrderMaster->has_flow_count == 1){
                $proformaInvoiceMaster->is_follow_pi = true;
                $proformaInvoiceMaster->pi_follow_count = $purchaseOrderMaster->revise_count;
            }
            else{
                $proformaInvoiceMaster->is_follow_pi = false;
                $proformaInvoiceMaster->pi_follow_count = 0;
            }


            $proformaInvoiceMaster->remarks = $request->pi_remarks;
            $proformaInvoiceMaster->terms_conditions = $request->terms_conditions;
            $proformaInvoiceMaster->bank_information = $request->bank_information;
            $proformaInvoiceMaster->total_pi_amount = $request->total_pi_amount;
            $proformaInvoiceMaster->total_pi_amount_words = $request->amount_in_words;
            $proformaInvoiceMaster->inserted_by = Auth::id();
            $proformaInvoiceMaster->pi_date = $request->pi_date;

            if($proformaInvoiceMaster->save()){
                $purchaseOrderMaster->pi_generation_activated = false;
                if($purchaseOrderMaster->save()){
                    $counter = 1;
                    foreach( $purchaseOrderDetails as $detail){
                        $proformaInvoiceDetail = new ProformaInvoiceDetail();

                        $proformaInvoiceDetail->proforma_invoice_master_id = $proformaInvoiceMaster->id;
                        $proformaInvoiceDetail->purchase_order_master_id = $request->purchase_order_master_id;
                        $proformaInvoiceDetail->purchase_order_detail_id = $detail->item_count;
                        $proformaInvoiceDetail->item_count = $counter;
                        $proformaInvoiceDetail->item_order_quantity = $detail->item_order_quantity;
                        $proformaInvoiceDetail->gross_calculation_amount = $detail->gross_calculation_amount;
                        $proformaInvoiceDetail->gross_item_order_quantity = $detail->gross_item_order_quantity;
                        $proformaInvoiceDetail->item_unit_price = $detail->unit_price_in_usd;
                        $proformaInvoiceDetail->add_amount_percent = $detail->add_amount_percent;
                        $proformaInvoiceDetail->gross_unit_price = $detail->gross_unit_price;
                        $proformaInvoiceDetail->total_price = (float)(((float)$detail->gross_item_order_quantity) * ((float)$detail->gross_unit_price));
                        if($proformaInvoiceDetail->save()){
                            $counter++;
                        }
                    }
                    return 'success';
                }
            }
        }
        else{
            return null;
        }

    }

    public function saveNewFollowPI(Request $request){

        $purchaseOrderMaster = PurchaseOrderMaster::find($request->purchase_order_master_id);

        $purchaseOrderDetails = PurchaseOrderDetail::orderBy('item_count')
            ->where('status','!=', 'D')
            ->where('purchase_order_master_id', $request->purchase_order_master_id)
            ->get();

        if($purchaseOrderDetails->count() > 0){

            $proformaInvoiceMaster = new ProformaInvoiceMaster();
            $ger_date = new Carbon($request->pi_date);
            $proformaInvoiceMaster->job_year = $ger_date->year;

            $lastProformaInvoiceMaster = ProformaInvoiceMaster::orderBy('job_no', 'DESC')
                ->where('status', '!=', 'D')
                ->where('lpd', 1)
                ->where('job_year', $ger_date->year)
                ->first();


            if($lastProformaInvoiceMaster == null){
                $proformaInvoiceMaster->job_no = 1;
            }
            else if($lastProformaInvoiceMaster->count() <= 0){
                $proformaInvoiceMaster->job_no = 1;
            }
            else{
                $proformaInvoiceMaster->job_no = $lastProformaInvoiceMaster->job_no + 1;
            }

            $proformaInvoiceMaster->lpd = $purchaseOrderMaster->lpd;
            $proformaInvoiceMaster->job_year = $ger_date->year;
            $proformaInvoiceMaster->purchase_order_master_id = $request->purchase_order_master_id;
            $proformaInvoiceMaster->is_revise = false;
            $proformaInvoiceMaster->pi_revise_count = 0;
            $proformaInvoiceMaster->is_follow_pi = true;

            $lastProformaInvoiceMasterForFlow = ProformaInvoiceMaster::orderBy('id', 'DESC')
                ->where('status', '!=' , "D")
                ->where('purchase_order_master_id', $purchaseOrderMaster->id)
                ->first();

            if($lastProformaInvoiceMasterForFlow == null){
                $proformaInvoiceMaster->pi_follow_count = 1;
            }
            else if($lastProformaInvoiceMasterForFlow->count() <= 0){
                $proformaInvoiceMaster->pi_follow_count = 1;
            }
            else{
                $proformaInvoiceMaster->pi_follow_count = $lastProformaInvoiceMasterForFlow->pi_follow_count + 1;
                //$proformaInvoiceMaster->job_no = $lastProformaInvoiceMaster->job_no + 1;
            }
            $proformaInvoiceMaster->remarks = $request->pi_remarks;
            $proformaInvoiceMaster->terms_conditions = $request->terms_conditions;
            $proformaInvoiceMaster->bank_information = $request->bank_information;
            $proformaInvoiceMaster->total_pi_amount = $request->total_pi_amount;
            $proformaInvoiceMaster->total_pi_amount_words = $request->amount_in_words;
            $proformaInvoiceMaster->inserted_by = Auth::id();
            $proformaInvoiceMaster->pi_date = $request->pi_date;

            if($proformaInvoiceMaster->save()){
                //$purchaseOrderMaster->pi_generation_activated = false;
                //need to update purchase order master for pi_generation_activated  issues
                if(!empty($request->get('purchase_order_detail_id'))){
                    $counter = 1;
                    foreach($request->get('purchase_order_detail_id') as $key => $v){
                        if(((float)$request->follow_pi_quantity[$key]) > 0){

                            $detail = PurchaseOrderDetail::where('item_count', $request->purchase_order_detail_id[$key])
                                ->where('purchase_order_master_id', $purchaseOrderMaster->id)
                                ->where('status', '!=', 'D')
                                ->first();

                            $proformaInvoiceDetail = new ProformaInvoiceDetail();
                            $proformaInvoiceDetail->purchase_order_master_id = $purchaseOrderMaster->id;
                            $proformaInvoiceDetail->proforma_invoice_master_id = $proformaInvoiceMaster->id;
                            $proformaInvoiceDetail->purchase_order_detail_id = $request->purchase_order_detail_id[$key];
                            $proformaInvoiceDetail->item_count = $counter;
                            $proformaInvoiceDetail->item_order_quantity = $request->follow_pi_quantity[$key];
                            $proformaInvoiceDetail->gross_calculation_amount = $detail->gross_calculation_amount;
                            $proformaInvoiceDetail->gross_item_order_quantity = ((float)$request->follow_pi_quantity[$key])/((float)$detail->gross_calculation_amount);
                            $proformaInvoiceDetail->item_unit_price = $detail->unit_price_in_usd;
                            $proformaInvoiceDetail->add_amount_percent = $detail->add_amount_percent;
                            $proformaInvoiceDetail->gross_unit_price = $detail->gross_unit_price;
                            $proformaInvoiceDetail->total_price = (float)((((float)$request->follow_pi_quantity[$key])/((float)$detail->gross_calculation_amount)) * ((float)$detail->gross_unit_price));
                            if($proformaInvoiceDetail->save()){

                                $total_order_detail = DB::table('purchase_order_details')
                                    ->where('purchase_order_master_id', $purchaseOrderMaster->id)
                                    ->where('status', '!=', 'D')
                                    ->selectRaw('SUM(item_order_quantity) AS total_order_quantity')
                                    ->first();

                                $total_pi_detail = DB::table('proforma_invoice_details')
                                    ->where('purchase_order_master_id', $purchaseOrderMaster->id)
                                    ->selectRaw('SUM(item_order_quantity) AS total_pi_quantity')
                                    ->first();

                                $result = ((float)$total_order_detail->total_order_quantity) - ((float)$total_pi_detail->total_pi_quantity);

                                $purchaseOrderMasterNew = PurchaseOrderMaster::find($purchaseOrderMaster->id);
                                if($result == 0){
                                    $purchaseOrderMasterNew->pi_generation_activated = false;
                                    if($purchaseOrderMasterNew->save()){
                                        //need to update purchase order master for pi_generation_activated  issues
                                        $counter++;
                                    }
                                }
                                else{
                                    $purchaseOrderMasterNew->pi_generation_activated = true;
                                    if($purchaseOrderMasterNew->save()){
                                        //need to update purchase order master for pi_generation_activated  issues
                                        $counter++;
                                    }
                                }

                            }
                        }
                    }

                    return "Success";
                }
            }
        }
        else{
            return null;
        }

    }

    public function updateSinglePI(Request $request){

        $proformaInvoiceMaster = ProformaInvoiceMaster::find($request->id);

        if($proformaInvoiceMaster != null){
            if($proformaInvoiceMaster->status == 'D'){
                return null;
            }
            else{

                $purchaseOrderMaster = PurchaseOrderMaster::find($request->purchase_order_master_id);

                $purchaseOrderDetails = PurchaseOrderDetail::orderBy('item_count')
                    ->where('status','!=', 'D')
                    ->where('purchase_order_master_id', $request->purchase_order_master_id)
                    ->get();

//                if($request->pi_date != $proformaInvoiceMaster->pi_date){
//                    $ger_date = new Carbon($request->pi_date);
//                    $proformaInvoiceMaster->job_year = $ger_date->year;
//
//                    $lastProformaInvoiceMaster = ProformaInvoiceMaster::orderBy('job_no', 'DESC')
//                        ->where('status','!=', 'D')
//                        ->where('job_year', $ger_date->year)
//                        ->first();
//
//                    if($lastProformaInvoiceMaster == null){
//                        $proformaInvoiceMaster->job_no = 1;
//                    }
//                    else if($lastProformaInvoiceMaster->count() >= 0){
//                        $proformaInvoiceMaster->job_no = 1;
//                    }
//                    else{
//                        $proformaInvoiceMaster->job_no = $lastProformaInvoiceMaster->job_no + 1;
//                    }
//                    $proformaInvoiceMaster->job_year = $ger_date->year;
//                    $proformaInvoiceMaster->pi_date = $request->pi_date;
//                }
                $proformaInvoiceMaster->pi_date = $request->pi_date;
                $proformaInvoiceMaster->lpd = $purchaseOrderMaster->lpd;
                $proformaInvoiceMaster->purchase_order_master_id = $request->purchase_order_master_id;
                if($proformaInvoiceMaster->status == 'A'){
                    $proformaInvoiceMaster->is_revise = true;
                    $proformaInvoiceMaster->pi_revise_count = $proformaInvoiceMaster->pi_revise_count + 1;
                }


                $proformaInvoiceMaster->is_follow_pi = false;
                $proformaInvoiceMaster->pi_follow_count = 0;
                $proformaInvoiceMaster->remarks = $request->pi_remarks;
                $proformaInvoiceMaster->terms_conditions = $request->terms_conditions;
                $proformaInvoiceMaster->bank_information = $request->bank_information;
                $proformaInvoiceMaster->total_pi_amount = $request->total_pi_amount;
                $proformaInvoiceMaster->total_pi_amount_words = $request->amount_in_words;
                $proformaInvoiceMaster->inserted_by = Auth::id();

                if($proformaInvoiceMaster->save()){
                    DB::table('proforma_invoice_details')->where('proforma_invoice_master_id', $request->id)->delete();
                    $purchaseOrderMaster->pi_generation_activated = false;
                    if($purchaseOrderMaster->save()){
                        $counter = 1;
                        foreach( $purchaseOrderDetails as $detail){
                            $proformaInvoiceDetail = new ProformaInvoiceDetail();

                            $proformaInvoiceDetail->proforma_invoice_master_id = $proformaInvoiceMaster->id;
                            $proformaInvoiceDetail->purchase_order_master_id = $request->purchase_order_master_id;
                            $proformaInvoiceDetail->purchase_order_detail_id = $detail->item_count;
                            $proformaInvoiceDetail->item_count = $counter;
                            $proformaInvoiceDetail->item_order_quantity = $detail->item_order_quantity;
                            $proformaInvoiceDetail->gross_calculation_amount = $detail->gross_calculation_amount;
                            $proformaInvoiceDetail->gross_item_order_quantity = $detail->gross_item_order_quantity;
                            $proformaInvoiceDetail->item_unit_price = $detail->unit_price_in_usd;
                            $proformaInvoiceDetail->add_amount_percent = $detail->add_amount_percent;
                            $proformaInvoiceDetail->gross_unit_price = $detail->gross_unit_price;
                            $proformaInvoiceDetail->total_price = (float)(((float)$detail->gross_item_order_quantity) * ((float)$detail->gross_unit_price));
                            if($proformaInvoiceDetail->save()){
                                $counter++;
                            }
                        }
                        return 'success';
                    }
                }
                return null;
            }
        }
        else{
            return null;
        }

    }

    public function updateFollowPI(Request $request){
        $proformaInvoiceMaster = ProformaInvoiceMaster::find($request->id);

        if($proformaInvoiceMaster != null){
            if($proformaInvoiceMaster->status == 'D'){
                return null;
            }
            else{

                $purchaseOrderMaster = PurchaseOrderMaster::find($request->purchase_order_master_id);

                $purchaseOrderDetails = PurchaseOrderDetail::orderBy('item_count')
                    ->where('status','!=', 'D')
                    ->where('purchase_order_master_id', $request->purchase_order_master_id)
                    ->get();


                /*if($request->pi_date != $proformaInvoiceMaster->pi_date){
                    $ger_date = new Carbon($request->pi_date);
                    $proformaInvoiceMaster->job_year = $ger_date->year;

                    $lastProformaInvoiceMaster = ProformaInvoiceMaster::orderBy('job_no', 'DESC')
                        ->where('status','!=', 'D')
                        ->where('job_year', $ger_date->year)
                        ->first();

                    if($lastProformaInvoiceMaster == null){
                        $proformaInvoiceMaster->job_no = 1;
                    }
                    else if($lastProformaInvoiceMaster->count() >= 0){
                        $proformaInvoiceMaster->job_no = 1;
                    }
                    else{
                        $proformaInvoiceMaster->job_no = $lastProformaInvoiceMaster->job_no + 1;
                    }
                    $proformaInvoiceMaster->job_year = $ger_date->year;
                    $proformaInvoiceMaster->pi_date = $request->pi_date;
                }*/
                $proformaInvoiceMaster->pi_date = $request->pi_date;
                $proformaInvoiceMaster->lpd = $purchaseOrderMaster->lpd;
                $proformaInvoiceMaster->purchase_order_master_id = $request->purchase_order_master_id;
                if($proformaInvoiceMaster->status == 'A'){
                    $proformaInvoiceMaster->is_revise = true;
                    $proformaInvoiceMaster->pi_revise_count = $proformaInvoiceMaster->pi_revise_count + 1;
                }

                $proformaInvoiceMaster->remarks = $request->pi_remarks;
                $proformaInvoiceMaster->terms_conditions = $request->terms_conditions;
                $proformaInvoiceMaster->bank_information = $request->bank_information;
                $proformaInvoiceMaster->total_pi_amount = $request->total_pi_amount;
                $proformaInvoiceMaster->total_pi_amount_words = $request->amount_in_words;
                $proformaInvoiceMaster->inserted_by = Auth::id();

                if($proformaInvoiceMaster->save()){
                    DB::table('proforma_invoice_details')->where('proforma_invoice_master_id', $request->id)->delete();

                    if($proformaInvoiceMaster->save()){
                        //$purchaseOrderMaster->pi_generation_activated = false;
                        //need to update purchase order master for pi_generation_activated  issues
                        if(!empty($request->get('purchase_order_detail_id'))){
                            $counter = 1;
                            foreach($request->get('purchase_order_detail_id') as $key => $v){
                                if(((float)$request->follow_pi_quantity[$key]) > 0){

                                    $detail = PurchaseOrderDetail::where('item_count', $request->purchase_order_detail_id[$key])
                                        ->where('purchase_order_master_id', $purchaseOrderMaster->id)
                                        ->where('status', '!=', 'D')
                                        ->first();

                                    $proformaInvoiceDetail = new ProformaInvoiceDetail();
                                    $proformaInvoiceDetail->purchase_order_master_id = $purchaseOrderMaster->id;
                                    $proformaInvoiceDetail->proforma_invoice_master_id = $proformaInvoiceMaster->id;
                                    $proformaInvoiceDetail->purchase_order_detail_id = $request->purchase_order_detail_id[$key];
                                    $proformaInvoiceDetail->item_count = $counter;
                                    $proformaInvoiceDetail->item_order_quantity = $request->follow_pi_quantity[$key];
                                    $proformaInvoiceDetail->gross_calculation_amount = $detail->gross_calculation_amount;
                                    $proformaInvoiceDetail->gross_item_order_quantity = ((float)$request->follow_pi_quantity[$key])/((float)$detail->gross_calculation_amount);
                                    $proformaInvoiceDetail->item_unit_price = $detail->unit_price_in_usd;
                                    $proformaInvoiceDetail->add_amount_percent = $detail->add_amount_percent;
                                    $proformaInvoiceDetail->gross_unit_price = $detail->gross_unit_price;
                                    $proformaInvoiceDetail->total_price = (float)((((float)$request->follow_pi_quantity[$key])/((float)$detail->gross_calculation_amount)) * ((float)$detail->gross_unit_price));
                                    if($proformaInvoiceDetail->save()){

                                        $total_order_detail = DB::table('purchase_order_details')
                                            ->where('purchase_order_master_id', $purchaseOrderMaster->id)
                                            ->where('status', '!=', 'D')
                                            ->selectRaw('SUM(item_order_quantity) AS total_order_quantity')
                                            ->first();

                                        $total_pi_detail = DB::table('proforma_invoice_details')
                                            ->where('purchase_order_master_id', $purchaseOrderMaster->id)
                                            ->selectRaw('SUM(item_order_quantity) AS total_pi_quantity')
                                            ->first();

                                        $result = ((float)$total_order_detail->total_order_quantity) - ((float)$total_pi_detail->total_pi_quantity);

                                        $purchaseOrderMasterNew = PurchaseOrderMaster::find($purchaseOrderMaster->id);
                                        if($result == 0){
                                            $purchaseOrderMasterNew->pi_generation_activated = false;
                                            if($purchaseOrderMasterNew->save()){
                                                //need to update purchase order master for pi_generation_activated  issues
                                                $counter++;
                                            }
                                        }
                                        else{
                                            $purchaseOrderMasterNew->pi_generation_activated = true;
                                            if($purchaseOrderMasterNew->save()){
                                                //need to update purchase order master for pi_generation_activated  issues
                                                $counter++;
                                            }
                                        }

                                    }
                                }
                            }

                            return "Success";
                        }
                    }
                }
                return null;
            }
        }
        else{
            return null;
        }

    }

    public function approvePI(Request $request){
        $proformaInvoice = ProformaInvoiceMaster::find($request->id);

        //  po master pi generation activated check korte hobe

        if($proformaInvoice != null){
            if($proformaInvoice->status != 'D'){
                if($proformaInvoice->is_follow_pi == false){
                    $proformaInvoice->status = 'A';
                    $proformaInvoice->updated_by = Auth::user()->id;
                    $proformaInvoice->approved_by = Auth::user()->id;
                    $proformaInvoice->approval_date = Carbon::now()->toDate();
                    if($proformaInvoice->save()){
                        return "update";
                    }
                    return null;
                }
                else{
                    // check inwords value first
                    $proformaInvoice->status = 'A';
                    $proformaInvoice->updated_by = Auth::user()->id;
                    $proformaInvoice->approved_by = Auth::user()->id;
                    $proformaInvoice->approval_date = Carbon::now()->toDate();
                    if($proformaInvoice->save()){
                        return "update";
                    }
                    return null;
                }

            }
            return null;
        }

        return null;
    }

    public function deletePI(Request $request){
        $proformaInvoice = ProformaInvoiceMaster::find($request->id);

        //  po master pi generation activated check korte hobe

        if($proformaInvoice != null){
            if($proformaInvoice->status != 'D'){
                if($proformaInvoice->is_follow_pi == false){
                    $proformaInvoice->status = 'D';
                    $proformaInvoice->updated_by = Auth::user()->id;

                    if($proformaInvoice->save()){
                        DB::table('proforma_invoice_details')->where('proforma_invoice_master_id', $request->id)->delete();
                        $purchaseOrderMaster = PurchaseOrderMaster::find($proformaInvoice->purchase_order_master_id);
                        $purchaseOrderMaster->pi_generation_activated = true;
                        if($purchaseOrderMaster->save()){
                            return "update";
                        }
                        return "update";

                    }
                    return null;
                }
                else{
                    //for follow pi approval

                    $proformaInvoice->status = 'D';
                    $proformaInvoice->updated_by = Auth::user()->id;

                    if($proformaInvoice->save()){
                        DB::table('proforma_invoice_details')->where('proforma_invoice_master_id', $request->id)->delete();
                        $purchaseOrderMaster = PurchaseOrderMaster::find($proformaInvoice->purchase_order_master_id);
                        $purchaseOrderMaster->pi_generation_activated = true;
                        if($purchaseOrderMaster->save()){
                            return "update";
                        }
                        return "update";

                    }
                    return null;
                }

            }
            return null;
        }

        return null;
    }


    public function disApprovePI(Request $request){
        $proformaInvoice = ProformaInvoiceMaster::find($request->id);
        if($proformaInvoice != null){
            if($proformaInvoice->status == 'A'){
                $proformaInvoice->status = 'I';
                $proformaInvoice->updated_by = Auth::user()->id;
                $proformaInvoice->approved_by = Auth::user()->id;
                $proformaInvoice->approval_date = Carbon::now()->toDate();
                if($proformaInvoice->save()){
                    return "update";
                }
                return null;
            }
            return null;
        }

        return null;
    }

    public function generateFollowPi($masterID){
        $purchaseOrderMaster = PurchaseOrderMaster::find($masterID);
        //******
    }

    public function download($id){
        //$requisitionMaster = RequisitionMaster::find($id);

        $proformaInvoice = ProformaInvoiceMaster::find($id);

        if($proformaInvoice == null){
            return redirect()->route('lpd1.proforma-invoice.po-list');
        }
        else if($proformaInvoice->status == 'D'){
            return redirect()->route('lpd1.proforma-invoice.po-list');
        }
        else{
            $purchaseOrder = PurchaseOrderMaster::find($proformaInvoice->purchase_order_master_id);

            // uniqtrimstypes e issue ase
            $uniqTrimsTypes = DB::table('proforma_invoice_details')
                ->join('proforma_invoice_masters', 'proforma_invoice_masters.id', '=', 'proforma_invoice_details.proforma_invoice_master_id')
                ->join('purchase_order_details', function ($join) {
                    $join->on('purchase_order_details.item_count', '=', 'proforma_invoice_details.purchase_order_detail_id');
                    $join->on('purchase_order_details.purchase_order_master_id', '=', 'proforma_invoice_masters.purchase_order_master_id');
                })
                ->join('trims_types', 'purchase_order_details.trims_type_id', '=', 'trims_types.id')
                ->select('trims_types.short_name', 'trims_types.name')
                ->where('proforma_invoice_details.proforma_invoice_master_id', $id)
                ->orderBy('trims_types.name')
                ->groupBy('purchase_order_details.trims_type_id', 'trims_types.short_name', 'trims_types.name')
                ->get();

            //check value

            $proformaInvoiceDetails = ProformaInvoiceDetail::orderBy('item_count')
                ->where('proforma_invoice_master_id', $id)
                ->get();

            $buyer = Buyer::find($purchaseOrder->buyer_id);

            $orderPrice =  DB::table('proforma_invoice_details')->select(DB::raw('sum(total_price) as total_items'))
                ->where('proforma_invoice_master_id', $id)
                ->first();

            $orderQty =  DB::table('proforma_invoice_details')->select(DB::raw('sum(gross_item_order_quantity) as total_items'))
                ->where('proforma_invoice_master_id', $id)
                ->first();

            return view('lpd1.proforma-invoice.pi-print-view', compact('proformaInvoice',
                'purchaseOrder', 'proformaInvoiceDetails', 'uniqTrimsTypes', 'buyer', 'orderPrice', 'orderQty'));
        }


    }
}
