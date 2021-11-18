<?php

namespace App\Http\Controllers\LPD2;

use App\FreeTrimsStock;
use App\Http\Controllers\Controller;
use App\PurchaseOrderMaster;
use App\TrimsStock;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class PurchaseOrderCloseController extends Controller
{
    //po close section

    public function closed(){
        $purchaseOrders = PurchaseOrderMaster::orderBy('lpd_po_no', 'DESC')
            ->where('status', 'PS')
            ->where('lpd', '2')
            ->take(1500)
            ->get();

        return view('lpd2.purchase-order.closed', compact('purchaseOrders'));
    }

    public function poCompleteRequest(Request $request){
        $purchaseOrder = PurchaseOrderMaster::find($request->id);

        if($purchaseOrder != null){
            $purchaseOrder->close_request = true;
            $purchaseOrder->close_requested_by = Auth::id();
            $purchaseOrder->close_request_date = Carbon::now();
            if($purchaseOrder->save()){
                return $request->id;
            }
            return null;
        }
        return null;
    }

    public function poCompleteApprove(Request $request){
        $purchaseOrder = PurchaseOrderMaster::find($request->id);

        if($purchaseOrder != null){
            $purchaseOrder->status = 'PS';
            $purchaseOrder->close_approval_date = Carbon::now();
            $purchaseOrder->close_approved_by = Auth::id();
            if($purchaseOrder->save()){

                // make current stock inactive
                $trimsStocks = DB::table('trims_stocks')->select('id')
                    ->where('status', '!=', 'D')
                    ->where('purchase_order_master_id', $request->id)
                    ->get();

                foreach ($trimsStocks as $item){
                    $trimsStock = TrimsStock::find($item->id);
                    if($trimsStock->status == 'A'){
                        $trimsStock->is_free_stock = true;
                        if($trimsStock->save()){
                            $freeTrimsStock = new FreeTrimsStock();
                            //$freeTrimsStock->trims_stock_id = 0;
                            $freeTrimsStock->purchase_order_master_id = $trimsStock->purchase_order_master_id;
                            $freeTrimsStock->purchase_order_detail_id = $trimsStock->purchase_order_detail_id;
                            $freeTrimsStock->stock_quantity = $trimsStock->stock_quantity;
                            $freeTrimsStock->delivered_quantity = $trimsStock->delivered_quantity;
                            $freeTrimsStock->inserted_by = Auth::id();
                            if($freeTrimsStock->save()){

                            }
                        }
                    }
                }
                //transfer to free stock list
                return $request->id;
            }
            return null;
        }
        return null;
    }

    public function poCompleteRestore(Request $request){
        $purchaseOrder = PurchaseOrderMaster::find($request->id);

        if($purchaseOrder != null){
            $purchaseOrder->close_request = false;
            if($purchaseOrder->save()){
                return $request->id;
            }
            return null;
        }
        return null;
    }

    // end po close section
}
