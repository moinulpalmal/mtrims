<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class PurchaseOrderMaster extends Model
{
    //

    public function purchase_order_detail()
    {
        return $this->hasOne('PurchaseOrderDetail', 'purchase_order_master_id', 'id');
    }

    public static function getActivePurchaseOrderByLpd($lpd){
        return PurchaseOrderMaster::orderBy('lpd_po_no', 'DESC')
            ->where('status', 'A')
            ->where('lpd', $lpd)
            ->get();

    }

    public static function getTotalOrderQuantity ($id){
        $result = DB::table('view_p_o_order_sum')
                    ->select('id', 'total_order_quantity')
                    ->where('id', $id)
                    ->get();

        if($result->count() > 0){
            $result[0]->total_order_quantity;
        }

        return 0;
    }

    public static function getTotalStockQuantity($id){
        $result = DB::table('view_p_o_stock_sum')
            ->select('id', 'total_stock_quantity')
            ->where('id', $id)
            ->get();

        if($result->count() > 0){
            $result[0]->total_order_quantity;
        }

        return 0;
    }

    public static function getTotalDeliveredQuantity($id){

    }
}
