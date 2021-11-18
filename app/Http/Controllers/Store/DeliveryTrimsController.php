<?php

namespace App\Http\Controllers\Store;

use App\DeliveryDetail;
use App\DeliveryDetailReplace;
use App\DeliveryMaster;
use App\Helpers\Helper;
use App\Http\Controllers\Controller;
use App\LeftOverTrimsStock;
use App\ProductionPlanDetailSetup;
use App\PurchaseOrderMaster;
use App\Store;
use App\TransportInfo;
use App\TrimsStock;
use App\TrimsType;
use App\Unit;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class DeliveryTrimsController extends Controller
{
    public function index(){
        $deliveryMasters = DeliveryMaster::orderBy('challan_date')
            ->where('status', '!=', 'D')
            ->take(3000)
            ->get();

        return view('store.delivery.trims.index', compact('deliveryMasters'));
    }

    public function deliveryPOList(){
        //$deliveryMasters = DeliveryMaster::orderBy('delivery_date')->where('status', '!=', 'D')->get();
        //$trimsTypes = TrimsType::orderBy('name')->where('status','!=', 'D')->get();

        $deliveryPOList = DB::table('trims_stocks')
            ->join('purchase_order_masters', 'trims_stocks.purchase_order_master_id', '=', 'purchase_order_masters.id')
//            ->join('trims_types', 'purchase_order_masters.trims_type_id', '=', 'trims_types.id')
            ->join('buyers', 'purchase_order_masters.buyer_id', '=', 'buyers.id')
            ->select('trims_stocks.purchase_order_master_id','purchase_order_masters.lpd_po_no',
                'purchase_order_masters.job_no', 'purchase_order_masters.lpd',
                'buyers.name AS buyer_name', 'purchase_order_masters.job_year')
            ->where('trims_stocks.status', 'A')
            ->where('trims_stocks.is_free_stock', false)
            ->groupBy('trims_stocks.purchase_order_master_id', 'purchase_order_masters.lpd_po_no',
                'purchase_order_masters.job_no', 'purchase_order_masters.lpd',
                'buyers.name', 'purchase_order_masters.job_year')
            ->get();

        return view('store.delivery.trims.po-list', compact('deliveryPOList'));
        //return $deliveryPOList;
    }

    public function createChallan($id){

        $deliveryItemList = DB::table('trims_stocks')
            ->join('purchase_order_details', function ($join) {
                $join->on('purchase_order_details.item_count', '=', 'trims_stocks.purchase_order_detail_id');
                $join->on('purchase_order_details.purchase_order_master_id', '=', 'trims_stocks.purchase_order_master_id');
            })
            ->join('units', 'units.id', '=', 'purchase_order_details.item_unit_id')
            ->join('trims_types', 'trims_types.id', '=', 'purchase_order_details.trims_type_id')
            ->select('purchase_order_details.style_no', 'purchase_order_details.item_size', 'purchase_order_details.item_color',
                'purchase_order_details.item_description', 'purchase_order_details.item_unit_id','units.short_unit AS full_unit',
                'trims_types.name AS trims_type_name',
                'trims_stocks.status', 'trims_stocks.purchase_order_master_id',  'purchase_order_details.trims_type_id',
                'trims_stocks.purchase_order_detail_id', 'trims_stocks.id' , 'trims_stocks.stock_quantity')
            ->where('trims_stocks.status', '=','A')
            ->where('trims_stocks.purchase_order_master_id', '=',$id)
            ->orderBy('trims_types.name')
            ->orderBy('purchase_order_details.style_no')
            ->get();

        //return $deliveryItemList;

        if($deliveryItemList->count() <= 0){
            return redirect()->route('store.delivery.trims.po-list');
        }

        $purchaseOrderMaster = PurchaseOrderMaster::find($id);

        if($purchaseOrderMaster == null){
            return redirect()->route('store.delivery.trims.po-list');
        }

        $stores = Store::getActiveStoreListForSelectField();
        $transports = TransportInfo::getTransportListForSelectList();
        $units = Unit::getActiveUnitListForSelect();

        return view('store.delivery.trims.new-challan', compact('deliveryItemList',
            'stores', 'purchaseOrderMaster', 'transports', 'units'));

    }

    public function saveChallan(Request $request){
        //return $request->all();

        if(!empty($request->get('trims_stock_id'))){
            $counter = 0;
            foreach($request->get('trims_stock_id') as $key => $v){
                $counter++;
            }
            $flowCounter = 0;
            foreach($request->get('trims_stock_id') as $key => $v){
                $qty = (float)$request->delivery_stock_quantity[$key];
                if($qty <= 0){
                    $flowCounter++;
                }
            }

            if($flowCounter >= $counter){
                return redirect()->route('store.delivery.trims.po-list');
            }
            else{
                $deliveryMaster = new DeliveryMaster();
                $deliveryMaster->store_id = $request->delivery_location_name;
                $deliveryMaster->transport_info_id = $request->transport_licence_no;
                //$deliveryMaster->driver_name = $request->driver_name;
                //$deliveryMaster->truck_no = $request->truck_no;
                $deliveryMaster->challan_date = $request->challan_date;
                if($request->is_replacement_challan == "on"){
                    $deliveryMaster->is_replacement_challan = true;
                }
                else{
                    $deliveryMaster->is_replacement_challan = false;
                }
                //$deliveryMaster->transport_name = $request->transport_name;
                $deliveryMaster->remarks = $request->remarks;
                $deliveryMaster->inserted_by = Auth::id();
                $deliveryMaster->purchase_order_master_id = $request->purchase_order_master_id;

                if($deliveryMaster->save()){

                    if(!empty($request->get('trims_stock_id')))            {

                        $masterId = $deliveryMaster->id;
                        $i = 1;
                        foreach($request->get('trims_stock_id') as $key => $v){
                            $qty = (float)$request->delivery_stock_quantity[$key];

                            if($qty > 0){
                                //return $request->all();
                                $purchaseOrderDetail = new DeliveryDetail();
                                $purchaseOrderDetail->delivery_master_id = $masterId;
                                $purchaseOrderDetail->trims_stock_id = $request->trims_stock_id[$key];
                                $purchaseOrderDetail->purchase_order_detail_id = $request->purchase_order_detail_id[$key];
                                $purchaseOrderDetail->item_count = $i;

                                $purchaseOrderDetail->gross_delivered_quantity = $request->delivery_stock_quantity[$key];
                                $purchaseOrderDetail->gross_quantity_factor = $request->gross_quantity_factor[$key];
                                $purchaseOrderDetail->gross_unit = $request->delivery_unit[$key];
                                $purchaseOrderDetail->delivered_quantity = $request->delivery_quantity[$key];


                                $purchaseOrderDetail->total_weight = $request->net_weight[$key];
                                $purchaseOrderDetail->gross_weight = $request->gross_weight[$key];
                                $purchaseOrderDetail->remarks = $request->item_remarks[$key];
                                if($purchaseOrderDetail->save()){
                                    $i++;
                                    $trimsStock = TrimsStock::find($request->trims_stock_id[$key]);
                                    $previousDeliveryQty = $trimsStock->delivered_quantity;
                                    $newDeliveryQty = $previousDeliveryQty + $request->gross_delivered_quantity[$key];
                                    $trimsStock->delivered_quantity = $newDeliveryQty;
                                    $trimsStock->stock_quantity = (float)$trimsStock->stock_quantity - (float)$request->delivery_stock_quantity[$key];

                                    if($trimsStock->save()){
                                        if($trimsStock->stock_quantity <= 0){
                                            $trimsStock->status = 'E';
                                            if($trimsStock->save()){

                                            }
                                        }

                                    }
                                }
                            }
                        }
                    }
                }
                return redirect()->route('store.delivery.trims.challan.print-view', ['id' => $deliveryMaster->id]);
            }

        }
        return redirect()->route('store.delivery.trims.po-list');
    }

    public function updateChallan(Request $request){
        $deliveryMaster = DeliveryMaster::find($request->delivery_master_id);

        if($deliveryMaster != null){
            $deliveryMaster->store_id = $request->delivery_location_name;
            $deliveryMaster->transpor_info_id = $request->transport_licence_no;
            if($request->is_replacement_challan == "on"){
                $deliveryMaster->is_replacement_challan = true;
            }
            else{
                $deliveryMaster->is_replacement_challan = false;
            }
            //$deliveryMaster->is_replacement_challan = $request->is_replacement_challan;
            $deliveryMaster->challan_date = $request->challan_date;
            //$deliveryMaster->licence_no = $request->licence_no;
            //$deliveryMaster->transport_name = $request->transport_name;
            $deliveryMaster->remarks = $request->remarks;
            $deliveryMaster->updated_by = Auth::id();

            if($deliveryMaster->save()){
                return 'Update';
            }
        }

        return null;

        //$deliveryMaster->purchase_order_master_id = $request->purchase_order_master_id;
    }

    public function detailChallan($id){
        $master = DeliveryMaster::find($id);
        if($master != null){
            if($master->status != 'D'){
                $transports = TransportInfo::getTransportListForSelectList();
                $stores = Store::getActiveStoreListForSelectField();
                $details = DeliveryDetail::where('delivery_master_id', $id)->get();
                //return $details;
                $replacementDetails = DeliveryDetailReplace::getRePlacementItemList($id);
                //return $replacementDetails;
                $purchaseOrderMaster = PurchaseOrderMaster::find($master->purchase_order_master_id);
                return view('store.delivery.trims.detail', compact('master', 'details',
                    'stores', 'purchaseOrderMaster', 'transports', 'replacementDetails'));
            }
            else{
                return redirect()->route('store.delivery.trims');
            }
        }
        else{
            return redirect()->route('store.delivery.trims');
        }
    }

    public function deleteChallan(Request $request){
        $master = DeliveryMaster::find($request->id);
        if($master != null){
            if($master->status != 'D'){
                //$details = DeliveryDetail::where('delivery_master_id', $id)->get();

                $master->status = 'D';
                $master->updated_by = Auth::id();

                if($master->save()){
                    $details = DeliveryDetail::where('delivery_master_id', $request->id)
                        ->get();
                    foreach ($details as $item){
                        // get plan detail setup

                        $trimsStock = TrimsStock::find($item->trims_stock_id);
                        $trimsStock->stock_quantity = (float)$trimsStock->stock_quantity + (float)$item->gross_delivered_quantity;
                        $trimsStock->status = 'A';

                        if($trimsStock->save()){

                        }
                    }
                    $details = DeliveryDetail::where('delivery_master_id', $request->id)->delete();
                    return 'Success';
                }
                return null;
            }
            else{
                return null;
            }
        }
        else{
            return null;
        }
    }

    public function deleteDetail(Request $request){
        $id = $request->get('item_id');

        $purchaseOrderDetail = DeliveryDetail::where('delivery_master_id', $request->delivery_master_id)
            ->where('item_count', $id)
            ->first();

        if($purchaseOrderDetail){
            $productionPlanDetailSetup = ProductionPlanDetailSetup::find($purchaseOrderDetail->production_plan_detail_setup_id);

            $previousDeliveryQty = $productionPlanDetailSetup->delivered_production;
            $newDeliveryQty = $previousDeliveryQty - $purchaseOrderDetail->delivered_quantity;
            $productionPlanDetailSetup->delivered_production = $newDeliveryQty;

            if($newDeliveryQty == $productionPlanDetailSetup->achievement_production){
                $productionPlanDetailSetup->status = 'DC';
            }
            else{
                $productionPlanDetailSetup->status = 'SI';
            }

            if($productionPlanDetailSetup->save()){

                $purchaseOrderDetail = DeliveryDetail::where('delivery_master_id', $request->delivery_master_id)
                    ->where('item_count', $id)
                    ->delete();

                if($purchaseOrderDetail){
                    return 'Updated';
                }

                return null;
            }
            else{
                return null;
            }
        }
        else{
            return null;
        }
    }

    public function approveChallan(Request $request){
        $master = DeliveryMaster::find($request->id);
        if($master != null){
            if($master->status != 'D'){
                //$details = DeliveryDetail::where('delivery_master_id', $id)->get();

                $master->status = 'AP';
                $master->updated_by = Auth::id();

                if($master->save()){


                    return 'Success';
                }
                return null;
            }
            else{
                return null;
            }
        }
        else{
            return null;
        }
    }

    public function saveDetail(Request $request){

        $id = $request->get('item_id');

        if(!empty($id)){
            $subContractor = DeliveryDetail::where('delivery_master_id', $request->delivery_master_id)
                ->where('item_count', $id)
                ->first();

            if(!empty($subContractor)){

                $result = DB::table('delivery_details')
                    ->where('item_count', $id)
                    ->where('delivery_master_id', $request->delivery_master_id)
                    ->update(['delivered_quantity' => $request->delivery_quantity,
                        'remarks' => $request->item_remarks]);

                if($result){

                    $productionPlanDetailSetup = ProductionPlanDetailSetup::find($subContractor->production_plan_detail_setup_id);

                    $previousDeliveryQty = $productionPlanDetailSetup->delivered_production;

                    $currentPreviousDeliveryQty = $previousDeliveryQty - $request->delivered_quantity;

                    $newDeliveryQty = $currentPreviousDeliveryQty + $request->delivery_quantity;

                    $productionPlanDetailSetup->delivered_production = $newDeliveryQty;

                    if($newDeliveryQty == $productionPlanDetailSetup->achievement_production){
                        $productionPlanDetailSetup->status = 'DC';
                    }
                    else{
                        $productionPlanDetailSetup->status = 'SI';
                    }

                    if($productionPlanDetailSetup->save()){
                        return 'Update';
                    }
                    else{
                        return null;
                    }
                }
            }
            return "Error";
        }
        return "Error";
    }

    public function editDetail(Request $request){
        $id = $request->get('item_count');

        $subContractor = DeliveryDetail::where('delivery_master_id', $request->delivery_master_id)
            ->where('item_count', $id)
            ->first();

        $master = DeliveryMaster::find($request->delivery_master_id);

        if($subContractor != null){
            $subContractorData = array(
                'style_no' => (Helper::TwoIDwiseData('purchase_order_details', 'purchase_order_master_id', $master->purchase_order_master_id, 'item_count', $subContractor->purchase_order_detail_id))->style_no,
                'item_size' => (Helper::TwoIDwiseData('purchase_order_details', 'purchase_order_master_id', $master->purchase_order_master_id, 'item_count', $subContractor->purchase_order_detail_id))->item_size,
                'item_color' => (Helper::TwoIDwiseData('purchase_order_details', 'purchase_order_master_id', $master->purchase_order_master_id, 'item_count', $subContractor->purchase_order_detail_id))->item_color,
                'item_description' =>(Helper::TwoIDwiseData('purchase_order_details', 'purchase_order_master_id', $master->purchase_order_master_id, 'item_count', $subContractor->purchase_order_detail_id))->item_description,
                'unit' => (Helper::IDwiseData('units', 'id', (Helper::TwoIDwiseData('purchase_order_details', 'purchase_order_master_id', $master->purchase_order_master_id, 'item_count', $subContractor->purchase_order_detail_id))->item_unit_id))->full_unit,
                'remarks' => $subContractor->remarks,
                'item_id' => $subContractor->item_count,
                'stock_quantity' => TrimsStock::getCurrentTrimsStock( $master->purchase_order_master_id, $subContractor->purchase_order_detail_id),
                'delivered_quantity' => $subContractor->delivered_quantity,
                'max_quantity' => $subContractor->delivered_quantity + TrimsStock::getCurrentTrimsStock( $master->purchase_order_master_id, $subContractor->purchase_order_detail_id)
            );
            return $subContractorData;
        }

        return null;
    }

    public function challanPrintView($id){
        $master = DeliveryMaster::find($id);
        if($master != null){
            if($master->status != 'D'){
                $details = DeliveryDetail::where('delivery_master_id', $id)->get();

                return view('store.delivery.trims.print-view', compact('master', 'details'));
            }
            else{
                return redirect()->route('store.delivery.trims');
            }
        }
        else{
            return redirect()->route('store.delivery.trims');
        }
    }

    //replacement section
    public function generateReplaceReq(Request $request){

        $delivery_detail_replace = new DeliveryDetailReplace();

        $delivery_detail_replace->purchase_order_master_id = $request->purchase_order_master_id;
        $delivery_detail_replace->purchase_order_detail_id = $request->purchase_order_detail_id;
        $delivery_detail_replace->delivery_master_id = $request->delivery_master_id;
        $delivery_detail_replace->delivery_detail_id = $request->delivery_detail_id;
        $delivery_detail_replace->replacement_reason = $request->replacement_reason;
        $delivery_detail_replace->remarks = $request->remarks;
        $delivery_detail_replace->requested_replace_quantity = $request->item_replace_request_qty;
        $delivery_detail_replace->inserted_by = Auth::id();
        $delivery_detail_replace->request_date = Carbon::now();

        if($delivery_detail_replace->save()){
            return 'Success';
        }
        return null;
    }
    //replacement section

    public function rejectReplaceReq(Request $request){
        $delivery_detail_replace = DeliveryDetailReplace::find($request->id);
        $delivery_detail_replace->status = 'R';
        $delivery_detail_replace->last_updated_by = Auth::id();

        if($delivery_detail_replace->save()){
            return 'Success';
        }
        return null;

    }

    public function deleteReplaceReq(Request $request){
        $delivery_detail_replace = DeliveryDetailReplace::find($request->id);
        $delivery_detail_replace->status = 'D';
        $delivery_detail_replace->last_updated_by = Auth::id();

        if($delivery_detail_replace->save()){
            return 'Success';
        }
        return null;

    }

    public function approveReplaceReq(Request $request){
        //return $request->all();
        $delivery_detail_replace = DeliveryDetailReplace::find($request->id);
        $requested_replace_quantity = (float)$delivery_detail_replace->requested_replace_quantity;
        $production_replace_quantity = (float)$request->production_replace_quantity;
        $non_production_replace_quantity = (float)$request->non_production_replace_quantity;
        $stored_production = (float)$request->stored_quantity;

        $result = $requested_replace_quantity - $production_replace_quantity - $non_production_replace_quantity - $stored_production;
        //return $result;

        //return $delivery_detail_replace;
        if( $result == 0){
            $delivery_detail_replace->status = 'A';
            $delivery_detail_replace->production_replace_quantity = $request->production_replace_quantity;
            $delivery_detail_replace->non_production_replace_quantity = $request->non_production_replace_quantity;
            $delivery_detail_replace->stored_quantity = $request->stored_quantity;
            $delivery_detail_replace->approved_by = Auth::id();
            $delivery_detail_replace->is_stored = true;
            $delivery_detail_replace->last_updated_by = Auth::id();
            if($delivery_detail_replace->save()){
                //store in trims stock
                    $trims_stock = TrimsStock::find(DeliveryDetail::getTrimsStockId($delivery_detail_replace->delivery_master_id,
                        $delivery_detail_replace->delivery_detail_id));

                    $grossQty = DeliveryDetail::getGrossQtyFactor($delivery_detail_replace->delivery_master_id, $delivery_detail_replace->delivery_detail_id);
                    $trims_stock->updated_by = Auth::id();
                    $trims_stock->stock_quantity = (float)$trims_stock->stock_quantity + ($stored_production * $grossQty);
                    $trims_stock->save();
                //left over stock
                    $leftOverId = LeftOverTrimsStock::getLeftOverTrimsStockId($trims_stock->id);
                    if($leftOverId == 0){
                        $left_over_trims_stock = new LeftOverTrimsStock();
                        $left_over_trims_stock->purchase_order_master_id = $delivery_detail_replace->purchase_order_master_id;
                        $left_over_trims_stock->purchase_order_detail_id = $delivery_detail_replace->purchase_order_detail_id;
                        $left_over_trims_stock->stock_quantity = ($production_replace_quantity * $grossQty);
                        $left_over_trims_stock->trims_stock_id = DeliveryDetail::getTrimsStockId($delivery_detail_replace->delivery_master_id,
                            $delivery_detail_replace->delivery_detail_id);
                        $left_over_trims_stock->inserted_by = Auth::id();
                        $left_over_trims_stock->save();
                    }
                    else{
                        $left_over_trims_stock = LeftOverTrimsStock::find($leftOverId);
                        $left_over_trims_stock->updated_by = Auth::id();
                        $left_over_trims_stock->stock_quantity = (float)$left_over_trims_stock->stock_quantity + ($production_replace_quantity * $grossQty);
                        $left_over_trims_stock->save();
                    }
                //non production setup
                return '2';
            }
            return null;
        }
        else{
            return '1';
        }

    }
}
