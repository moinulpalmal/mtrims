<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TrimsStock extends Model
{
    public static function getCurrentTrimsStock($purchase_order_master_id, $purchase_order_detail_id){
        $trim_stock = TrimsStock::select('stock_quantity')
            ->where('purchase_order_master_id', $purchase_order_master_id)
            ->where('purchase_order_detail_id', $purchase_order_detail_id)
            ->get();

        return $trim_stock[0]->stock_quantity;
    }

    public static function getCurrentTrimsStockId($purchase_order_master_id, $purchase_order_detail_id){
        $trim_stock = TrimsStock::select('id')
            ->where('purchase_order_master_id', $purchase_order_master_id)
            ->where('purchase_order_detail_id', $purchase_order_detail_id)
            ->get();

        if($trim_stock->count() > 0){
            return $trim_stock[0]->id;
        }

        return  0;

    }
}
