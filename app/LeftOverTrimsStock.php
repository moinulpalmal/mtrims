<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class LeftOverTrimsStock extends Model
{
    public static function getLeftOverTrimsStockId($trims_stock_id){
        $result = DB::table('left_over_trims_stocks')
        ->select('id')
        ->where('trims_stock_id', $trims_stock_id)
        ->get();

        if($result->count() > 0)
        {
           return $result[0]->id;
        }

        return 0;
    }

    public static function getLeftOverTrimsStocks(){
        return DB::table('left_over_trims_stocks')
            ->join('purchase_order_masters', 'left_over_trims_stocks.purchase_order_master_id', '=', 'purchase_order_masters.id')
            ->join('purchase_order_details', function ($join) {
                $join->on('purchase_order_details.item_count', '=', 'left_over_trims_stocks.purchase_order_detail_id');
                $join->on('purchase_order_details.purchase_order_master_id', '=', 'left_over_trims_stocks.purchase_order_master_id');
            })
            ->join('buyers', 'purchase_order_masters.buyer_id', '=', 'buyers.id')
            ->join('trims_types', 'purchase_order_details.trims_type_id', '=', 'trims_types.id')
            ->join('units', 'purchase_order_details.item_unit_id', '=', 'units.id')
            ->select('purchase_order_masters.lpd', 'left_over_trims_stocks.stock_quantity', 'left_over_trims_stocks.delivered_quantity',
                'purchase_order_masters.lpd_po_no', 'purchase_order_details.style_no','buyers.name AS buyer', 'left_over_trims_stocks.id',
                'purchase_order_details.item_size', 'purchase_order_details.item_color', 'purchase_order_details.item_description',
                'units.short_unit', 'trims_types.name AS trims_type', 'left_over_trims_stocks.status')
            ->where('left_over_trims_stocks.status', 'A')
            ->get();
    }
}
