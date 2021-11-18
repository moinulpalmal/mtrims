<?php

namespace App\Http\Controllers\Store;

use App\FreeTrimsStock;
use App\FreeTrimsToLeftOver;
use App\Http\Controllers\Controller;
use App\LeftOverTrimsStock;
use App\ProductionPlanDetailSetup;
use App\TrimsStock;
use App\TrimsType;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class StoreTrimsController extends Controller
{
    public function index(){
        $trimsTypes = TrimsType::orderBy('name')->where('status','!=', 'D')->get();
        //$activeProductionPlans = ProductionPlanDetailSetup::orderBy('production_date', 'ASC')->where('status', 'SI')->get();

        $activeProductionPlans = DB::table('trims_stocks')
            ->join('purchase_order_masters', 'trims_stocks.purchase_order_master_id', '=', 'purchase_order_masters.id')
            ->join('purchase_order_details', function ($join) {
                $join->on('purchase_order_details.item_count', '=', 'trims_stocks.purchase_order_detail_id');
                $join->on('purchase_order_details.purchase_order_master_id', '=', 'trims_stocks.purchase_order_master_id');
            })
            ->join('buyers', 'purchase_order_masters.buyer_id', '=', 'buyers.id')
            ->join('trims_types', 'purchase_order_details.trims_type_id', '=', 'trims_types.id')
            ->join('units', 'purchase_order_details.item_unit_id', '=', 'units.id')
            ->select('purchase_order_masters.lpd', 'trims_stocks.stock_quantity', 'trims_stocks.delivered_quantity',
                'purchase_order_masters.lpd_po_no', 'purchase_order_details.style_no','buyers.name AS buyer', 'trims_stocks.id',
                'purchase_order_details.item_size', 'purchase_order_details.item_color', 'purchase_order_details.item_description',
                'units.short_unit', 'trims_types.name AS trims_type')
            ->where('trims_stocks.status', 'A')
            ->where('trims_stocks.is_free_stock', false)
            ->get();

        //return $activeProductionPlans;
        return view('store.stock.trims.index', compact('activeProductionPlans', 'trimsTypes'));
    }

    public function leftOver(){
        $trimsTypes = TrimsType::orderBy('name')->where('status','!=', 'D')->get();
        $activeProductionPlans = LeftOverTrimsStock::getLeftOverTrimsStocks();
        return view('store.stock.trims.left-over', compact('activeProductionPlans', 'trimsTypes'));
    }


    public function blocked(){
        $trimsTypes = TrimsType::orderBy('name')->where('status','!=', 'D')->get();
        //$activeProductionPlans = ProductionPlanDetailSetup::orderBy('production_date', 'ASC')->where('status', 'SI')->get();

        $activeProductionPlans =FreeTrimsStock::getBlockedTrimsStocks();

        //return $activeProductionPlans;
        return view('store.stock.trims.blocked', compact('activeProductionPlans', 'trimsTypes'));
    }

    public function receiveInStockApproved(Request $request)
    {
        $supplier = ProductionPlanDetailSetup::find($request->id);
        $supplier->status = 'SA';
        if($supplier->save()){
            return true;
        }
        return 'Error';

    }

    public function rejectStock(Request $request)
    {
        $supplier = ProductionPlanDetailSetup::find($request->id);
        $supplier->status = 'PC';
        if($supplier->save()){
            return true;
        }
        return 'Error';

    }
    //free trims stock
    public function free(){
        //$trimsTypes = TrimsType::orderBy('name')->where('status','!=', 'D')->get();
        //$activeProductionPlans = ProductionPlanDetailSetup::orderBy('production_date', 'ASC')->where('status', 'SI')->get();

        $activeProductionPlans = FreeTrimsStock::getFreeTrimsStocks();

        //return $activeProductionPlans;
        return view('store.stock.trims.free', compact('activeProductionPlans'));
    }

    public function requestedLeftover(){
        //$trimsTypes = TrimsType::orderBy('name')->where('status','!=', 'D')->get();
        //$activeProductionPlans = ProductionPlanDetailSetup::orderBy('production_date', 'ASC')->where('status', 'SI')->get();

        $activeProductionPlans = FreeTrimsToLeftOver::getRequestedList();

        //return  $activeProductionPlans;

        //return $activeProductionPlans;
        return view('store.stock.trims.free-to-request-left-over', compact('activeProductionPlans'));
    }

    public function rejectFreeToLeftOver(Request $request){
        $leftOverRequest = FreeTrimsToLeftOver::find($request->id);
        if($leftOverRequest != null){
            $leftOverRequest->status = "R";
            $leftOverRequest->last_updated_by = Auth::id();
            if($leftOverRequest->save()){
                $freeTrimsStock = FreeTrimsStock::find($leftOverRequest->free_trims_stock_id);
                if($freeTrimsStock != null){
                    $freeTrimsStock->stock_quantity = (float)$freeTrimsStock->stock_quantity + (float)$leftOverRequest->requested_left_over_quantity;
                    $freeTrimsStock->updated_by = Auth::id();
                    if($freeTrimsStock->save()){
                        return 'Success';
                    }
                    else{
                        return null;
                    }
                }
                else{
                    $leftOverRequest->status = "I";
                    $leftOverRequest->last_updated_by = Auth::id();
                    $leftOverRequest->save();
                    return null;
                }
            }
        }

        return null;
    }

    public function approveFreeToLeftOve(Request $request){
        //return $request->all();
        if((float)$request->item_approve_qty <= 0){
            return 1;
        }
        else{
            $free_to_left_over = FreeTrimsToLeftOver::find($request->id);
            if($free_to_left_over != null){
                $free_to_left_over->approved_left_over_quantity = $request->item_approve_qty;
                //$free_to_left_over->approved_left_over_quantity = $request->item_approve_qty;
                $free_to_left_over->remarks = $request->remarks;
                $free_to_left_over->request_approve_date = Carbon::now();
                $free_to_left_over->approved_by = Auth::id();
                $free_to_left_over->last_updated_by = Auth::id();
                $free_to_left_over->status = 'A';
                if($free_to_left_over->save()){
                    $free_trims_stock = FreeTrimsStock::find($free_to_left_over->free_trims_stock_id);
                    $free_trims_stock->stock_quantity = (float)$free_trims_stock->stock_quantity
                        +( (float)$request->item_request_qty - (float)$request->item_approve_qty );

                    $free_trims_stock->updated_by = Auth::id();
                    if($free_trims_stock->save()){

                        //return $free_trims_stock;
                        //add to
                        $currentStockInfo = DB::table('left_over_trims_stocks')
                            ->select('id')
                            ->where('purchase_order_master_id',  $free_trims_stock->purchase_order_master_id)
                            ->where('purchase_order_detail_id',  $free_trims_stock->purchase_order_detail_id)
                            ->where('status', '!=', 'D')
                            ->first();


                        if($currentStockInfo == null){
                            $trims_stock = new LeftOverTrimsStock();
                            $trims_stock->purchase_order_master_id = $free_trims_stock->purchase_order_master_id;
                            $trims_stock->purchase_order_detail_id = $free_trims_stock->purchase_order_detail_id;
                            $trims_stock->stock_quantity = $request->item_approve_qty;
                            $trims_stock->trims_stock_id = TrimsStock::getCurrentTrimsStockId($free_trims_stock->purchase_order_master_id,
                                $free_trims_stock->purchase_order_detail_id);
                            $trims_stock->inserted_by = Auth::id();

                            if($trims_stock->save()){
                                return 2;
                            }

                            return null;
                        }
                        else{
                            $trims_stock = LeftOverTrimsStock::find($currentStockInfo->id);

                            $trims_stock->stock_quantity = $trims_stock->stock_quantity + $request->item_approve_qty;
                            $trims_stock->status = 'A';
                            $trims_stock->updated_by = Auth::id();
                            $trims_stock->trims_stock_id = TrimsStock::getCurrentTrimsStockId($free_trims_stock->purchase_order_master_id,
                                $free_trims_stock->purchase_order_detail_id);
                            if($trims_stock->save()){
                                return 2;
                            }

                            return null;
                        }

                        return 2;
                    }
                }

                return null;
            }

            return 3;
        }
    }

    public function requestFreeToLeftOver(Request $request){
       // return $request->all();

        if((float)$request->item_request_qty <= 0){
            return 1;
        }
        else{
            $free_trims_stock = FreeTrimsStock::find($request->id);
            if($free_trims_stock != null){
                $free_to_left_over = new FreeTrimsToLeftOver();
                $free_to_left_over->free_trims_stock_id = $free_trims_stock->id;
                $free_to_left_over->left_over_reason = $request->replacement_reason;
                $free_to_left_over->requested_left_over_quantity = $request->item_request_qty;
                $free_to_left_over->remarks = $request->remarks;
                $free_to_left_over->request_date = Carbon::now();
                $free_to_left_over->inserted_by = Auth::id();
                if($free_to_left_over->save()){
                    $free_trims_stock->stock_quantity = (float)$free_trims_stock->stock_quantity
                                                            - (float)$request->item_request_qty;

                    $free_trims_stock->updated_by = Auth::id();
                    if($free_trims_stock->save()){
                        return 2;
                    }
                }

                return 3;
            }
            return 3;
        }
       // $request->all();
        //return null;
    }
    //end free trims stock
    //transfer to left over from free trims stock
    //public function
    //end transfer to left over from free trims stock
}
