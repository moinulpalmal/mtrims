<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class DeliveryDetail extends Model
{
    public static function getTrimsStockId($delivery_master_id, $delivery_detail_id){
        $trims_stock = DB::table('delivery_details')
            ->select('trims_stock_id')
            ->where('delivery_master_id', $delivery_master_id)
            ->where('item_count', $delivery_detail_id)
            ->get();

        if($trims_stock->count() > 0){
            return $trims_stock[0]->trims_stock_id;
        }

        return  null;

    }

    public static function getGrossQtyFactor($delivery_master_id, $delivery_detail_id){
        $trims_stock = DB::table('delivery_details')
            ->select('gross_quantity_factor')
            ->where('delivery_master_id', $delivery_master_id)
            ->where('item_count', $delivery_detail_id)
            ->get();

        if($trims_stock->count() > 0){
            return (float)($trims_stock[0]->gross_quantity_factor);
        }

        return  null;

    }
}
