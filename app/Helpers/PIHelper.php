<?php
namespace App\Helpers;
use App\MachineSetup;
use App\ProductionPlanDetailSetup;
use App\PurchaseOrderDetail;
use Illuminate\Support\Facades\DB;


class PIHelper{

    public static function getPIItemPendingQuantity($poMasterId, $poDetailID){
        $orderQty =  DB::table('purchase_order_details')->select(DB::raw('sum(item_order_quantity) as total_order'))
            ->where('status', '!=', 'D')
            ->where('purchase_order_master_id', $poMasterId)
            ->where('item_count', $poDetailID)
            ->first();

        $piQuantity = DB::table('proforma_invoice_details')->select(DB::raw('sum(item_order_quantity) as total_pi_qty'))
            ->where('purchase_order_master_id', $poMasterId)
            ->where('purchase_order_detail_id', $poDetailID)
            ->first();

        $totalOrderQty = (float)$orderQty->total_order;
        $totalPiQty = (float)$piQuantity->total_pi_qty;

        return ($totalOrderQty-$totalPiQty);
    }

    public static function getPIItemCurrentQuantity($masterId, $detailId){
        $piQuantity = DB::table('proforma_invoice_details')->select(DB::raw('sum(item_order_quantity) as total_pi_qty'))
            ->where('proforma_invoice_master_id', $masterId)
            ->where('purchase_order_detail_id', $detailId)
            ->first();

        if($piQuantity->total_pi_qty == null)
            return 0;

        return $piQuantity->total_pi_qty;
    }

    public static function getPIItemCurrentTotalPrice($masterId, $detailId){
        $piQuantity = DB::table('proforma_invoice_details')->select(DB::raw('sum(total_price) as total_pi_qty'))
            ->where('proforma_invoice_master_id', $masterId)
            ->where('purchase_order_detail_id', $detailId)
            ->first();

        if($piQuantity->total_pi_qty == null)
            return 0;

        return $piQuantity->total_pi_qty;
    }

    public static function getTotalPIValue($masterId){
        $piQuantity = DB::table('proforma_invoice_details')->select(DB::raw('sum(total_price) as total_pi_qty'))
            ->where('proforma_invoice_master_id', $masterId)
            ->first();

        return $piQuantity->total_pi_qty;
    }

}
