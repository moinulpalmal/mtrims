<?php

namespace App\Http\Controllers\Store;

use App\DeliveryDetail;
use App\DeliveryDetailReplace;
use App\Helpers\Helper;
use App\Http\Controllers\Controller;
use App\LeftOverTrimsStock;
use App\ProductionPlanDetailSetup;
use App\TrimsStock;
use App\TrimsType;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class StoreTrimsReceiveController extends Controller
{
    public function inHouseReceiveAble(){
        $trimsTypes = TrimsType::orderBy('name')->where('status','!=', 'D')->get();

        $activeProductionPlans = ProductionPlanDetailSetup::orderBy('production_date', 'ASC')
            ->where('status', 'PC')
            ->where('is_stored', false)
            ->get();

        return view('store.receive.trims.in-house-receive-able', compact('activeProductionPlans', 'trimsTypes'));
    }

    public function leftOverReceiveAble(){
        $trimsTypes = TrimsType::orderBy('name')->where('status','!=', 'D')->get();

        $activeProductionPlans = ProductionPlanDetailSetup::orderBy('production_date', 'ASC')
            ->where('status', 'PC')
            ->where('is_left_over_stored', false)
            ->where('is_stored', true)
            ->get();

        return view('store.receive.trims.left-over-receive-able', compact('activeProductionPlans', 'trimsTypes'));
    }

    public function nonProductionReceiveAble(){
        $trimsTypes = TrimsType::orderBy('name')->where('status','!=', 'D')->get();

        $activeProductionPlans = DeliveryDetailReplace::orderBy('id', 'ASC')
            ->where('status', 'A')
            ->where('is_non_production_stored', false)
            ->get();

        return view('store.receive.trims.non-production-receive-able', compact('activeProductionPlans', 'trimsTypes'));
    }

    public function receiveInNonProductionStock(Request $request){
        $deliveryDetailReplace = DeliveryDetailReplace::find($request->id);
        if($deliveryDetailReplace != null){
            $trims_stock_id = DeliveryDetail::getTrimsStockId($deliveryDetailReplace->delivery_master_id, $deliveryDetailReplace->delivery_detail_id);
            $trims_stock = TrimsStock::find($trims_stock_id);
            $trims_stock->stock_quantity = $trims_stock->stock_quantity +
                ($deliveryDetailReplace->non_production_replace_quantity *
                    DeliveryDetail::getGrossQtyFactor($deliveryDetailReplace->delivery_master_id, $deliveryDetailReplace->delivery_detail_id));
            $trims_stock->status = 'A';
            $trims_stock->updated_by = Auth::id();
            if($trims_stock->save()){
                $deliveryDetailReplace->is_non_production_stored = true;
                $deliveryDetailReplace->last_updated_by = Auth::id();
                if($deliveryDetailReplace->save()){
                    return 'success';
                }
            }
        }
        return null;
    }

    public function receiveInStock(Request $request)
    {
        $supplier = ProductionPlanDetailSetup::find($request->id);
        $supplier->is_stored = true;
        $supplier->stored_production = $supplier->achievement_production;
        if($supplier->save()){

            $currentStockInfo = DB::table('trims_stocks')
                ->select('id')
                ->where('purchase_order_master_id', $supplier->purchase_order_master_id)
                ->where('purchase_order_detail_id', $supplier->purchase_order_detail_id)
                ->where('status', '!=', 'D')
                ->first();

            // add left over entry from here
            if($currentStockInfo == null){
                $trims_stock = new TrimsStock();
                $trims_stock->purchase_order_master_id = $supplier->purchase_order_master_id;
                $trims_stock->purchase_order_detail_id = $supplier->purchase_order_detail_id;
                $trims_stock->stock_quantity = $supplier->achievement_production;
                $trims_stock->inserted_by = Auth::id();

                if($trims_stock->save()){
                    return 'success';
                }
            }
            else{
                $trims_stock = TrimsStock::find($currentStockInfo->id);

                $trims_stock->stock_quantity = $trims_stock->stock_quantity + $supplier->achievement_production;
                $trims_stock->status = 'A';
                $trims_stock->updated_by = Auth::id();
                if($trims_stock->save()){
                    return 'success';
                }
            }

            // fill or update stock table
            return null;
        }
        return null;
    }


    public function receiveInLeftOverStock(Request $request)
    {
        $supplier = ProductionPlanDetailSetup::find($request->id);
        $supplier->is_left_over_stored = true;
        //$supplier->stored_production = $supplier->achievement_production;
        if($supplier->save()){

            $currentStockInfo = DB::table('left_over_trims_stocks')
                ->select('id')
                ->where('purchase_order_master_id', $supplier->purchase_order_master_id)
                ->where('purchase_order_detail_id', $supplier->purchase_order_detail_id)
                ->where('status', '!=', 'D')
                ->first();

            if($currentStockInfo == null){
                $trims_stock = new LeftOverTrimsStock();
                $trims_stock->purchase_order_master_id = $supplier->purchase_order_master_id;
                $trims_stock->purchase_order_detail_id = $supplier->purchase_order_detail_id;
                $trims_stock->stock_quantity = $supplier->left_over_production;
                $trims_stock->trims_stock_id = TrimsStock::getCurrentTrimsStockId($supplier->purchase_order_master_id,
                                                                                    $supplier->purchase_order_detail_id);
                $trims_stock->inserted_by = Auth::id();

                if($trims_stock->save()){
                    return 'success';
                }
            }
            else{
                $trims_stock = LeftOverTrimsStock::find($currentStockInfo->id);
                $trims_stock->stock_quantity = $trims_stock->stock_quantity + $supplier->left_over_production;
                $trims_stock->status = 'A';
                $trims_stock->updated_by = Auth::id();
                $trims_stock->trims_stock_id = TrimsStock::getCurrentTrimsStockId($supplier->purchase_order_master_id,
                    $supplier->purchase_order_detail_id);
                if($trims_stock->save()){
                    return 'success';
                }
            }

            // fill or update stock table
            return null;
        }
        return null;
    }

    public function index(){
        $trimsTypes = TrimsType::orderBy('name')->where('status','!=', 'D')->get();

        $activeProductionPlans = ProductionPlanDetailSetup::orderBy('production_date', 'ASC')
            ->where('status', 'PC')
            ->where('is_stored', true)
            ->get();

        return view('store.receive.trims.index', compact('activeProductionPlans', 'trimsTypes'));

    }

    public function leftOverIndex(){
        $trimsTypes = TrimsType::orderBy('name')->where('status','!=', 'D')->get();

        $activeProductionPlans = ProductionPlanDetailSetup::orderBy('production_date', 'ASC')
            ->where('status', 'PC')
            ->where('is_left_over_stored', true)
            ->get();

        return view('store.receive.trims.index-left-over', compact('activeProductionPlans', 'trimsTypes'));
    }

    public function nonProductionIndex(){
        $trimsTypes = TrimsType::orderBy('name')->where('status','!=', 'D')->get();

        $activeProductionPlans = DeliveryDetailReplace::orderBy('id', 'ASC')
            ->where('status', 'A')
            ->where('is_non_production_stored', true)
            ->get();

        return view('store.receive.trims.index-non-production', compact('activeProductionPlans', 'trimsTypes'));
    }

    public function rejectStock(Request $request)
    {
        $productionPlan = ProductionPlanDetailSetup::find($request->id);
        $productionPlan->updated_by =  Auth::id();
        $productionPlan->status =  'A';
        if($productionPlan->save()){
            return  'update';
        }


        return null;

    }

    /*public function inHouseReceiveAble(){
        $trimsTypes = TrimsType::orderBy('name')->where('status','!=', 'D')->get();
        $activeProductionPlans = ProductionPlanDetailSetup::orderBy('production_date', 'ASC')
            ->where('status', 'PC')
            ->where('is_stored', false)
            ->get();

        return view('store.receive.trims.in-house-receive-able', compact('activeProductionPlans', 'trimsTypes'));
    }*/


}
