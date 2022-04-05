<?php

namespace App\Http\Controllers\LPD1;

use App\Buyer;
use App\DeliveryMaster;
use App\Factory;
use App\FreeTrimsStock;
use App\Http\Controllers\Controller;
use App\ProductionPlanDetailSetup;
use App\ProformaInvoice;
use App\PurchaseOrderDetail;
use App\PurchaseOrderMaster;
use App\Store;
use App\TrimsType;
use App\Unit;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class PurchaseOrderController extends Controller
{
    public function index(){
        $purchaseOrders = PurchaseOrderMaster::getActivePurchaseOrderByLpd(1);
        return view('lpd1.purchase-order.index', compact('purchaseOrders'));
    }

    public function newPurchaseOrder(){
        $buyers = Buyer::getActiveBuyerListForSelect();
        $factories = Factory::getActiveFactoryListForSelect();
        $units = Unit::getActiveUnitListForSelect();
        $trimsTypes = TrimsType::GetLpdActiveTrimsTypesForSelectField(1);
        $stores = Store::getActiveStoreListForSelectField();

        return view('lpd1.purchase-order.add',compact('units','buyers', 'trimsTypes', 'factories', 'stores'));
    }

    public function savePurchaseOrder(Request $request){
        // print_r($request->all());

        $this->validate($request, [

            'lpd_po_no' => 'required|numeric',
            'buyer_po_no' => 'required|string',
            'buyer_name' => 'required|numeric',
            'primary_delivery_location' => 'required|numeric',
            'purchase_order_date' => 'required|date',
            'requisition_image_type.*' => 'numeric',
            'item_size' => 'required',
            'item_size.*' => 'required|string',
            'item_color' => 'required',
            'item_color.*' => 'required|string',
            'item_description' => 'required',
            'item_description.*' => 'required|string',
            'item_unit' => 'required',
            'item_unit.*' => 'required|numeric',
            'unit_price' => 'required',
            'unit_price.*' => 'required|numeric',
            'total' => 'required',
            'total.*' => 'required|numeric',
            'quantity' => 'required',
            'quantity.*' => 'required|numeric',
            'style_no' => 'required',
            'style_no.*' => 'required|string'
        ]);

        $purchaseOrderMaster = new PurchaseOrderMaster();

        $purchaseOrderMaster->lpd_po_no = $request->lpd_po_no;
        //$purchaseOrderMaster->trims_type_id = $request->trims_type;
        //$purchaseOrderMaster->job_year = Carbon::now()->year;
        $get_date = new Carbon($request->purchase_order_date);
        //$year = $request->po_date->format('Y');
        $purchaseOrderMaster->job_year = $get_date->year;

        $lastPurchaseOrderMaster = PurchaseOrderMaster::orderBy('job_no', 'DESC')
            ->where('job_year', $get_date->year)
            ->first();

        if($lastPurchaseOrderMaster == null){
            $purchaseOrderMaster->job_no = 1;
        }
        else{
            $purchaseOrderMaster->job_no = $lastPurchaseOrderMaster->job_no + 1;
        }
        $purchaseOrderMaster->buyer_id = $request->buyer_name;
        $purchaseOrderMaster->buyer_po_no = $request->buyer_po_no;
        $purchaseOrderMaster->primary_delivery_location_id = $request->primary_delivery_location;
        $purchaseOrderMaster->remarks = $request->remarks;
        $purchaseOrderMaster->lpd = 1;
        $purchaseOrderMaster->pi_count = 0;
        $purchaseOrderMaster->factory_id = $request->factory_name;
        $purchaseOrderMaster->pi_generation_activated = true;
        $purchaseOrderMaster->status = 'A';
        $purchaseOrderMaster->po_date = $request->purchase_order_date;

        //pitash
        $purchaseOrderMaster->po_type = $request->po_type;
        if($request->is_urgent == 'on')
        {
            $purchaseOrderMaster->is_urgent = true;
        }
        else
        {
            $purchaseOrderMaster->is_urgent = false;
        }

        if($request->has_flow_count == 'on')
        {
            $purchaseOrderMaster->has_flow_count = true;
            $purchaseOrderMaster->flow_count = $request->flow_count;
        }
        else
        {
            $purchaseOrderMaster->has_flow_count = false;
        }
        //pitash

        if(Auth::user()->id == null){
            return redirect()->route('lpd1.purchase.order');
        }
        $purchaseOrderMaster->inserted_by = Auth::user()->id;

        if($purchaseOrderMaster->save()){
            if(!empty($request->get('style_no')))
            {
                $masterId = $purchaseOrderMaster->id;
                $i = 1;
                foreach($request->get('style_no') as $key => $v){
                    $purchaseOrderDetail = new PurchaseOrderDetail();
                    $purchaseOrderDetail->purchase_order_master_id = $masterId;
                    $purchaseOrderDetail->style_no = $request->style_no[$key];
                    $purchaseOrderDetail->trims_type_id = $request->trims_type[$key];
                    $purchaseOrderDetail->item_size = $request->item_size[$key];
                    $purchaseOrderDetail->item_color = $request->item_color[$key];
                    $purchaseOrderDetail->item_description = $request->item_description[$key];
                    $purchaseOrderDetail->item_unit_id = $request->item_unit[$key];
                    $purchaseOrderDetail->remarks = $request->item_remarks[$key];
                    $purchaseOrderDetail->item_order_quantity = $request->quantity[$key];
                    $purchaseOrderDetail->sample_item_order_quantity = $request->s_quantity[$key];
                    $purchaseOrderDetail->gross_calculation_amount = $request->gross[$key];
                    $purchaseOrderDetail->gross_item_order_quantity = $request->gross_quantity[$key];
                    $purchaseOrderDetail->gross_sample_item_order_quantity = $request->s_gross_quantity[$key];
                    $purchaseOrderDetail->unit_price_in_usd = $request->unit_price[$key];
                    $purchaseOrderDetail->add_amount_percent = $request->add_percent[$key];
                    $purchaseOrderDetail->gross_unit_price = $request->gross_unit_price[$key];
                    $purchaseOrderDetail->total_price_in_usd = $request->total[$key];
                    $purchaseOrderDetail->status = 'A';
                    $purchaseOrderDetail->item_count = $i;
                    if($purchaseOrderDetail->save()){
                        $i++;
                    }
                }
            }
        }
        return redirect()->route('lpd1.purchase.order.detail', ['id' => $purchaseOrderMaster->id]);
    }


    public function getPurchaseOrderDetail(Request $req)
    {
        return PurchaseOrderMaster::getPurchaseOrderDetail($req);
    }

    public function getPODetailTrim(Request $req)
    {
        return PurchaseOrderDetail::getUniqueTrim($req);
    }

    public function details($id){
        $purchaseOrder = PurchaseOrderMaster::find($id);
        if($purchaseOrder->lpd==1){
            if($purchaseOrder == null){
                return redirect()->route('lpd1.purchase.order');
            }
            else if($purchaseOrder->status == 'D'){
                return redirect()->route('lpd1.purchase.order');
            }
            else if($purchaseOrder->status == 'CP'){
                return redirect()->route('lpd1.purchase.order');
            }
            else{

                $buyers = Buyer::getActiveBuyerListForSelect();
                $factories = Factory::getActiveFactoryListForSelect();
                $units = Unit::getActiveUnitListForSelect();
                $trimsTypes = TrimsType::GetLpdActiveTrimsTypesForSelectField(1);
                $stores = Store::getActiveStoreListForSelectField();

                // $uniqTrimsTypes = DB::table('purchase_order_details')
                //                 ->join('trims_types', 'purchase_order_details.trims_type_id', '=', 'trims_types.id')
                //                 ->select('trims_types.short_name', 'trims_types.name')
                //                 ->where('purchase_order_details.purchase_order_master_id', $id)
                //                 ->orderBy('trims_types.name')
                //                 ->groupBy('purchase_order_details.trims_type_id', 'trims_types.short_name', 'trims_types.name')
                //                 ->get();


                $deliveryMasters = DeliveryMaster::orderBy('challan_date', 'DESC')
                    ->where('status', '!=', 'D')
                    ->where('purchase_order_master_id', $id)
                    ->get();

                $proformaInvoices = ProformaInvoice::orderBy('pi_count')
                    ->where('purchase_order_master_id', $id)
                    ->where('status', '!=', 'D')
                    ->where('pi_count', $purchaseOrder->pi_count)
                    ->get();


                $productionPlanDetails = ProductionPlanDetailSetup::orderBy('production_date', 'ASC')
                    ->where('purchase_order_master_id', $id)
                    ->where('status', '!=', 'D')
                    ->get();

                $deleteAccess = true;

                foreach ($productionPlanDetails as $item){
                    if($item->achievement_production > 0){
                        $deleteAccess = false;
                        break;
                    }
                }

                // $currentStocks = DB::table('trims_stocks')
                //     ->join('purchase_order_masters', 'trims_stocks.purchase_order_master_id', '=', 'purchase_order_masters.id')
                //     ->join('purchase_order_details', function ($join) {
                //         $join->on('purchase_order_details.item_count', '=', 'trims_stocks.purchase_order_detail_id');
                //         $join->on('purchase_order_details.purchase_order_master_id', '=', 'trims_stocks.purchase_order_master_id');
                //     })
                //     ->join('buyers', 'purchase_order_masters.buyer_id', '=', 'buyers.id')
                //     ->join('trims_types', 'purchase_order_details.trims_type_id', '=', 'trims_types.id')
                //     ->join('units', 'purchase_order_details.item_unit_id', '=', 'units.id')
                //     ->select('purchase_order_masters.lpd', 'trims_stocks.stock_quantity', 'trims_stocks.delivered_quantity',
                //         'purchase_order_masters.lpd_po_no', 'purchase_order_details.style_no','buyers.name AS buyer', 'trims_stocks.status', 'trims_stocks.is_free_stock',
                //         'purchase_order_details.item_size', 'purchase_order_details.item_color', 'purchase_order_details.item_description',  'trims_stocks.id',
                //         'units.short_unit', 'trims_types.name AS trims_type')
                //     ->where('trims_stocks.status', '!=','D')
                //     ->where('purchase_order_masters.id', $id)
                //     ->get();

                //$activeProductionPlans = ProductionPlanDetailSetup::orderBy('production_date', 'ASC')->where('status', 'SI')->get();
                $deliveryData = DB::table('delivery_details')
                    ->join('delivery_masters', 'delivery_masters.id', '=', 'delivery_details.delivery_master_id')
                    ->join('purchase_order_details', function ($join) {
                        $join->on('purchase_order_details.item_count', '=', 'delivery_details.purchase_order_detail_id');
                        $join->on('purchase_order_details.purchase_order_master_id', '=', 'delivery_masters.purchase_order_master_id');
                    })
                    ->join('purchase_order_masters', 'purchase_order_details.purchase_order_master_id', '=', 'purchase_order_masters.id')
                    ->join('units', 'purchase_order_details.item_unit_id', '=', 'units.id')
                    ->join('stores', 'delivery_masters.store_id', '=', 'stores.id')
                    ->join('trims_types', 'purchase_order_details.trims_type_id', '=', 'trims_types.id')
                    ->select('purchase_order_masters.lpd',
                        'purchase_order_masters.lpd_po_no', 'purchase_order_details.style_no', 'stores.name AS store_name',
                        'purchase_order_details.item_size', 'purchase_order_details.item_color', 'purchase_order_details.item_description',
                        'delivery_masters.challan_date', 'delivery_masters.id AS challan_no', 'delivery_details.remarks', 'delivery_details.total_weight',
                        'delivery_details.delivered_quantity', 'delivery_details.gross_delivered_quantity', 'delivery_details.gross_unit',
                        'delivery_details.gross_weight',
                        'units.short_unit', 'delivery_masters.status', 'trims_types.name AS trims_type')
                    ->where('delivery_masters.status', '!=','D')
                    ->where('purchase_order_masters.id', $id)
                    ->orderBy('delivery_masters.challan_date')
                    ->orderBy('trims_types.name')
                    ->get();

                    // 'purchaseOrderDetails','uniqTrimsTypes', 'currentStocks','deliveryData', 
                return view('lpd1.purchase-order.detail', compact('units','buyers', 'trimsTypes',
                        'factories', 'stores', 'purchaseOrder', 'deliveryMasters',
                         'deleteAccess','proformaInvoices', 'productionPlanDetails'));
            } // other data
        }
        else{
            return redirect()->route('lpd1.purchase.order');
        }
    }

    public function delete(Request $request){
        $purchaseOrder = PurchaseOrderMaster::find($request->id);

        if($purchaseOrder != null){
            $purchaseOrder->status = 'D';
            if($purchaseOrder->save()){
                return $request->id;
            }
            return null;
        }
        return null;
    }



    public function editDetail(Request $request){        
        
        return PurchaseOrderDetail::getPOProductListEditDetail($request);
        
    }

    public function saveDetail(Request $request){      
        
        // return $request->all();

        $id = $request->get('item_id');

        if(!empty($id)){
            return PurchaseOrderDetail::updatePOProductList($request, $id);
        }
        else
        {
            return PurchaseOrderDetail::insertPOProductList($request);
        }
    }

    public function deleteDetail(Request $request){

        $id = $request->get('item_id');

        $purchaseOrderDetail = PurchaseOrderDetail::where('purchase_order_master_id', $request->purchase_order_master_id)
            ->where('item_count', $id)
            ->first();

        if(!empty($purchaseOrderDetail)){

            return PurchaseOrderDetail::deletePOProductList($request, $id);

            // $result = DB::table('purchase_order_details')
            //     ->where('item_count', $id)
            //     ->where('purchase_order_master_id', $request->purchase_order_master_id)
            //     ->update(['status' => 'D']);

            // if($result){
            //     $purchaseOrder = PurchaseOrderMaster::find($request->purchase_order_master_id);
            //     $purchaseOrder->pi_generation_activated = true;
            //     $purchaseOrder->save();
            //     return 'Updated';
            // }
            // return "Error";
        }

        return '0';
    }

    public function proposeDate(Request $request){
        $purchaseOrderMaster = PurchaseOrderMaster::find($request->purchase_order_master_id);
        if($purchaseOrderMaster != null){
            $purchaseOrderMaster->proposed_production_start_date = $request->production_start_date;
            $purchaseOrderMaster->proposed_delivery_end_date = $request->delivery_end_date;
            if($purchaseOrderMaster->save()){
                return "updated";
            }
            return "Error";
        }

        return "Error";
    }

    public function updatePurchaseOrder(Request $request){
        
        $this->validate($request, [
            'buyer_name' => 'required|numeric',
            'buyer_po_no' => 'required|string',
            'factory_name' => 'required|numeric',
            'po_type' => 'required',
            'primary_delivery_location' => 'required|numeric',
            'lpd_po_no' => 'required|numeric',
            'purchase_order_date' => 'required|date'
        ]);

        $purchaseOrderMaster = PurchaseOrderMaster::find($request->purchase_order_master_id);

        if($purchaseOrderMaster != null){

            $purchaseOrderMaster->buyer_id = $request->buyer_name;
            $purchaseOrderMaster->buyer_po_no = $request->buyer_po_no;
            $purchaseOrderMaster->primary_delivery_location_id = $request->primary_delivery_location;
            $purchaseOrderMaster->remarks = $request->remarks;
            $purchaseOrderMaster->lpd = 1;
            $purchaseOrderMaster->factory_id = $request->factory_name;
            $purchaseOrderMaster->pi_generation_activated = true;
            $purchaseOrderMaster->po_date = $request->purchase_order_date;

            //pitash
            $purchaseOrderMaster->revise_count = $request->revise_count;
            $purchaseOrderMaster->lpd_po_no = $request->lpd_po_no;
            $purchaseOrderMaster->po_type = $request->po_type;
            if($request->get('is_urgent') == 1)
            {
                $purchaseOrderMaster->is_urgent = true;
            }
            else
            {
                $purchaseOrderMaster->is_urgent = false;
            }
            if($request->get('has_flow_count') == 1)
            {
                $purchaseOrderMaster->has_flow_count = true;
                $purchaseOrderMaster->flow_count = $request->flow_count;
            }
            else
            {
                $purchaseOrderMaster->flow_count = $request->flow_count;
                $purchaseOrderMaster->has_flow_count = false;
            }

            //pitash

            // if(Auth::user()->id == null){
            //     return redirect()->route('lpd2.purchase.order');
            // }

            $purchaseOrderMaster->last_updated_by = Auth::user()->id;
            if($purchaseOrderMaster->save()){
                return "2";
            }
        }

        return "0";

    }

    public function approveDate(Request $request){
        $purchaseOrderMaster = PurchaseOrderMaster::find($request->purchase_order_master_id);
        if($purchaseOrderMaster != null){
            $purchaseOrderMaster->sample_submission_date = $request->sample_submission_date;
            $purchaseOrderMaster->production_start_date = $request->production_start_date;
            $purchaseOrderMaster->production_end_date = $request->production_end_date;
            $purchaseOrderMaster->delivery_start_date = $request->delivery_start_date;
            $purchaseOrderMaster->delivery_end_date = $request->delivery_end_date;
            $purchaseOrderMaster->approval_date = Carbon::now();
            $purchaseOrderMaster->status = 'A';
            $purchaseOrderMaster->approved_by = Auth::user()->id;
            if($purchaseOrderMaster->save()){
                return "updated";
            }
            return null;
        }

        return null;
    }



    public function planReport($id){
        $purchaseOrder = PurchaseOrderMaster::find($id);
        if($purchaseOrder->lpd == 1){
            if($purchaseOrder == null){
                return redirect()->route('lpd1.purchase.order');
            }
            else if($purchaseOrder->status == 'D'){
                return redirect()->route('lpd1.purchase.order');
            }
            else if($purchaseOrder->status == 'CP'){
                return redirect()->route('lpd1.purchase.order');
            }
            else{

                $uniqTrimsTypes = DB::table('purchase_order_details')
                                    ->join('trims_types', 'purchase_order_details.trims_type_id', '=', 'trims_types.id')
                                    ->select('trims_types.short_name', 'trims_types.name')
                                    ->where('purchase_order_details.purchase_order_master_id', $id)
                                    ->orderBy('trims_types.name')
                                    ->groupBy('purchase_order_details.trims_type_id', 'trims_types.short_name', 'trims_types.name')
                                    ->get();

                // $productionPlanDetails = ProductionPlanDetailSetup::where('purchase_order_master_id', $id)
                //     ->where('status', '!=', 'D')
                //     ->orderBy('production_date', 'DESC')
                //     ->get();

                return view('lpd1.purchase-order.plan-print-view',
                    compact('uniqTrimsTypes', 'purchaseOrder','productionPlanDetails'));
            } // other data
        }
        else{
            return redirect()->route('lpd1.purchase.order');
        }
    }

    public function achievementReport($id){
        $purchaseOrder = PurchaseOrderMaster::find($id);
        if($purchaseOrder->lpd == 1){
            if($purchaseOrder == null){
                return redirect()->route('lpd1.purchase.order');
            }
            else if($purchaseOrder->status == 'D'){
                return redirect()->route('lpd1.purchase.order');
            }
            else if($purchaseOrder->status == 'CP'){
                return redirect()->route('lpd1.purchase.order');
            }
            else{

                $uniqTrimsTypes = DB::table('purchase_order_details')
                                    ->join('trims_types', 'purchase_order_details.trims_type_id', '=', 'trims_types.id')
                                    ->select('trims_types.short_name', 'trims_types.name')
                                    ->where('purchase_order_details.purchase_order_master_id', $id)
                                    ->orderBy('trims_types.name')
                                    ->groupBy('purchase_order_details.trims_type_id', 'trims_types.short_name', 'trims_types.name')
                                    ->get();

                $productionPlanDetails = ProductionPlanDetailSetup::where('purchase_order_master_id', $id)
                    ->where('status', '!=', 'D')
                    ->orderBy('production_date', 'DESC')
                    ->get();

                // , 'productionPlanDetails'
                return view('lpd1.purchase-order.achievement-print-view',
                    compact('uniqTrimsTypes', 'purchaseOrder','productionPlanDetails'));
            } // other data
        }
        else{
            return redirect()->route('lpd1.purchase.order');
        }
    }

    public function currentStockReport($id){
        $purchaseOrder = PurchaseOrderMaster::find($id);
        if($purchaseOrder->lpd == 1){
            if($purchaseOrder == null){
                return redirect()->route('lpd1.purchase.order');
            }
            else if($purchaseOrder->status == 'D'){
                return redirect()->route('lpd1.purchase.order');
            }
            else if($purchaseOrder->status == 'CP'){
                return redirect()->route('lpd1.purchase.order');
            }
            else{

                $uniqTrimsTypes = DB::table('purchase_order_details')
                                    ->join('trims_types', 'purchase_order_details.trims_type_id', '=', 'trims_types.id')
                                    ->select('trims_types.short_name', 'trims_types.name')
                                    ->where('purchase_order_details.purchase_order_master_id', $id)
                                    ->orderBy('trims_types.name')
                                    ->groupBy('purchase_order_details.trims_type_id', 'trims_types.short_name', 'trims_types.name')
                                    ->get();

                $productionPlanDetails = DB::table('trims_stocks')
                    ->join('purchase_order_masters', 'trims_stocks.purchase_order_master_id', '=', 'purchase_order_masters.id')
                    ->join('purchase_order_details', function ($join) {
                        $join->on('purchase_order_details.item_count', '=', 'trims_stocks.purchase_order_detail_id');
                        $join->on('purchase_order_details.purchase_order_master_id', '=', 'trims_stocks.purchase_order_master_id');
                    })
                    ->join('buyers', 'purchase_order_masters.buyer_id', '=', 'buyers.id')
                    ->join('trims_types', 'purchase_order_details.trims_type_id', '=', 'trims_types.id')
                    ->join('units', 'purchase_order_details.item_unit_id', '=', 'units.id')
                    ->select('purchase_order_masters.lpd', 'trims_stocks.stock_quantity', 'trims_stocks.delivered_quantity',
                        'purchase_order_masters.lpd_po_no', 'purchase_order_details.style_no','buyers.name AS buyer',
                        'purchase_order_details.item_size', 'purchase_order_details.item_color', 'purchase_order_details.item_description', 'trims_stocks.id',
                        'units.short_unit', 'trims_types.name AS trims_type')
                    ->where('trims_stocks.status', 'A')
                    ->where('purchase_order_masters.id', $id)
                    ->get();

                return view('lpd1.purchase-order.stock-print-view',
                    compact('uniqTrimsTypes', 'productionPlanDetails', 'purchaseOrder'));
            } // other data
        }
        else{
            return redirect()->route('lpd1.purchase.order');
        }
    }

    public function deliveryReport($id){
        $purchaseOrder = PurchaseOrderMaster::find($id);
        if($purchaseOrder->lpd == 1){
            if($purchaseOrder == null){
                return redirect()->route('lpd1.purchase.order');
            }
            else if($purchaseOrder->status == 'D'){
                return redirect()->route('lpd1.purchase.order');
            }
            else if($purchaseOrder->status == 'CP'){
                return redirect()->route('lpd1.purchase.order');
            }
            else{

                $uniqTrimsTypes = DB::table('purchase_order_details')
                                    ->join('trims_types', 'purchase_order_details.trims_type_id', '=', 'trims_types.id')
                                    ->select('trims_types.short_name', 'trims_types.name')
                                    ->where('purchase_order_details.purchase_order_master_id', $id)
                                    ->orderBy('trims_types.name')
                                    ->groupBy('purchase_order_details.trims_type_id', 'trims_types.short_name', 'trims_types.name')
                                    ->get();
                                    
                $deliveryData = DB::table('delivery_details')
                    ->join('delivery_masters', 'delivery_masters.id', '=', 'delivery_details.delivery_master_id')
                    ->join('purchase_order_details', function ($join) {
                        $join->on('purchase_order_details.item_count', '=', 'delivery_details.purchase_order_detail_id');
                        $join->on('purchase_order_details.purchase_order_master_id', '=', 'delivery_masters.purchase_order_master_id');
                    })
                    ->join('trims_types', 'trims_types.id', '=', 'purchase_order_details.trims_type_id')
                    ->join('purchase_order_masters', 'purchase_order_details.purchase_order_master_id', '=', 'purchase_order_masters.id')
                    ->join('units', 'purchase_order_details.item_unit_id', '=', 'units.id')
                    //->join('production_plan_detail_setups', 'delivery_details.production_plan_detail_setup_id', '=', 'production_plan_detail_setups.id')
                    ->join('stores', 'delivery_masters.store_id', '=', 'stores.id')
                    ->select('purchase_order_masters.lpd',
                        'purchase_order_masters.lpd_po_no', 'purchase_order_details.style_no', 'stores.name AS store_name',
                        'purchase_order_details.item_size', 'purchase_order_details.item_color', 'purchase_order_details.item_description',
                        'delivery_masters.challan_date', 'delivery_masters.id AS challan_no', 'delivery_details.remarks',
                        'delivery_details.delivered_quantity','units.short_unit','trims_types.name AS trims_type_name')
                    ->where('delivery_masters.status', 'AP')
                    ->where('purchase_order_masters.id', $id)
                    ->orderBy('delivery_masters.challan_date')
                    ->get();

                return view('lpd1.purchase-order.delivery-print-view',
                    compact('uniqTrimsTypes', 'deliveryData', 'purchaseOrder'));
            } // other data
        }
        else{
            return redirect()->route('lpd1.purchase.order');
        }
    }
    public function deliveryReportNotApproved($id){
        $purchaseOrder = PurchaseOrderMaster::find($id);
        if($purchaseOrder->lpd == 1){
            if($purchaseOrder == null){
                return redirect()->route('lpd1.purchase.order');
            }
            else if($purchaseOrder->status == 'D'){
                return redirect()->route('lpd1.purchase.order');
            }
            else if($purchaseOrder->status == 'CP'){
                return redirect()->route('lpd1.purchase.order');
            }
            else{

                $uniqTrimsTypes = DB::table('purchase_order_details')
                                    ->join('trims_types', 'purchase_order_details.trims_type_id', '=', 'trims_types.id')
                                    ->select('trims_types.short_name', 'trims_types.name')
                                    ->where('purchase_order_details.purchase_order_master_id', $id)
                                    ->orderBy('trims_types.name')
                                    ->groupBy('purchase_order_details.trims_type_id', 'trims_types.short_name', 'trims_types.name')
                                    ->get();

                $deliveryData = DB::table('delivery_details')
                    ->join('delivery_masters', 'delivery_masters.id', '=', 'delivery_details.delivery_master_id')
                    ->join('purchase_order_details', function ($join) {
                        $join->on('purchase_order_details.item_count', '=', 'delivery_details.purchase_order_detail_id');
                        $join->on('purchase_order_details.purchase_order_master_id', '=', 'delivery_masters.purchase_order_master_id');
                    })
                    ->join('trims_types', 'trims_types.id', '=', 'purchase_order_details.trims_type_id')
                    ->join('purchase_order_masters', 'purchase_order_details.purchase_order_master_id', '=', 'purchase_order_masters.id')
                    ->join('units', 'purchase_order_details.item_unit_id', '=', 'units.id')
                   // ->join('production_plan_detail_setups', 'delivery_details.production_plan_detail_setup_id', '=', 'production_plan_detail_setups.id')
                    ->join('stores', 'delivery_masters.store_id', '=', 'stores.id')
                    ->select('purchase_order_masters.lpd',
                        'purchase_order_masters.lpd_po_no', 'purchase_order_details.style_no', 'stores.name AS store_name',
                        'purchase_order_details.item_size', 'purchase_order_details.item_color', 'purchase_order_details.item_description',
                        'delivery_masters.challan_date', 'delivery_masters.id AS challan_no', 'delivery_details.remarks',
                        'delivery_details.delivered_quantity','units.short_unit','trims_types.name AS trims_type_name')
                    ->where('delivery_masters.status', 'A')
                    ->where('purchase_order_masters.id', $id)
                    ->orderBy('delivery_masters.challan_date')
                    ->get();

                return view('lpd1.purchase-order.delivery-not-print-view',
                    compact('uniqTrimsTypes', 'deliveryData', 'purchaseOrder'));
            } // other data
        }
        else{
            return redirect()->route('lpd1.purchase.order');
        }
    }


}
