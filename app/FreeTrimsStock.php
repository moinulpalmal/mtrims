<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class FreeTrimsStock extends Model
{
    public static function getFreeTrimsStocks(){
        return DB::table('free_trims_stocks')
            ->join('purchase_order_masters', 'free_trims_stocks.purchase_order_master_id', '=', 'purchase_order_masters.id')
            ->join('purchase_order_details', function ($join) {
                $join->on('purchase_order_details.item_count', '=', 'free_trims_stocks.purchase_order_detail_id');
                $join->on('purchase_order_details.purchase_order_master_id', '=', 'free_trims_stocks.purchase_order_master_id');
            })
            ->join('buyers', 'purchase_order_masters.buyer_id', '=', 'buyers.id')
            ->join('trims_types', 'purchase_order_details.trims_type_id', '=', 'trims_types.id')
            ->join('units', 'purchase_order_details.item_unit_id', '=', 'units.id')
            ->select('purchase_order_masters.lpd', 'free_trims_stocks.stock_quantity', 'free_trims_stocks.delivered_quantity',
                'purchase_order_masters.lpd_po_no', 'purchase_order_details.style_no','buyers.name AS buyer', 'free_trims_stocks.id',
                'purchase_order_details.item_size', 'purchase_order_details.item_color', 'purchase_order_details.item_description',
                'units.short_unit', 'trims_types.name AS trims_type', 'free_trims_stocks.status')
            ->where('free_trims_stocks.status', 'F')
            ->get();
    }

    public static function  getBlockedTrimsStocks(){
        return DB::table('free_trims_stocks')
            ->join('purchase_order_masters', 'free_trims_stocks.purchase_order_master_id', '=', 'purchase_order_masters.id')
            ->join('purchase_order_details', function ($join) {
                $join->on('purchase_order_details.item_count', '=', 'free_trims_stocks.purchase_order_detail_id');
                $join->on('purchase_order_details.purchase_order_master_id', '=', 'free_trims_stocks.purchase_order_master_id');
            })
            ->join('buyers', 'purchase_order_masters.buyer_id', '=', 'buyers.id')
            ->join('trims_types', 'purchase_order_details.trims_type_id', '=', 'trims_types.id')
            ->join('units', 'purchase_order_details.item_unit_id', '=', 'units.id')
            ->select('purchase_order_masters.lpd', 'free_trims_stocks.stock_quantity', 'free_trims_stocks.delivered_quantity',
                'purchase_order_masters.lpd_po_no', 'purchase_order_details.style_no','buyers.name AS buyer', 'free_trims_stocks.id',
                'purchase_order_details.item_size', 'purchase_order_details.item_color', 'purchase_order_details.item_description',
                'units.short_unit', 'trims_types.name AS trims_type', 'free_trims_stocks.status')
            ->where('free_trims_stocks.status', 'B')
            ->get();
    }

    public  static function searchFreeTrimsStocks($trims_type_id, $item_size, $item_color, $item_description){
        $search_result = DB::table('free_trims_stocks')
            ->join('purchase_order_masters', 'free_trims_stocks.purchase_order_master_id', '=', 'purchase_order_masters.id')
            ->join('purchase_order_details', function ($join) {
                $join->on('purchase_order_details.item_count', '=', 'free_trims_stocks.purchase_order_detail_id');
                $join->on('purchase_order_details.purchase_order_master_id', '=', 'free_trims_stocks.purchase_order_master_id');
            })
            ->join('buyers', 'purchase_order_masters.buyer_id', '=', 'buyers.id')
            ->join('trims_types', 'purchase_order_details.trims_type_id', '=', 'trims_types.id')
            ->join('units', 'purchase_order_details.item_unit_id', '=', 'units.id')
            ->select('purchase_order_masters.lpd', 'free_trims_stocks.stock_quantity', 'free_trims_stocks.delivered_quantity',
                'purchase_order_masters.lpd_po_no', 'purchase_order_details.style_no','buyers.name AS buyer', 'free_trims_stocks.id',
                'purchase_order_details.item_size', 'purchase_order_details.item_color', 'purchase_order_details.item_description',
                'units.short_unit', 'trims_types.name AS trims_type', 'free_trims_stocks.status')
            ->where('free_trims_stocks.status', 'F')
            ->where('purchase_order_details.trims_type_id', $trims_type_id)

            ->get();


        if(!empty( $item_size)){
            $search_result = $search_result->where('purchase_order_details.item_size', 'LIKE', "%{$item_size}%");
        }

        if(!empty($department_id)){
            $search_result = $search_result->where('purchase_order_details.item_color', 'LIKE', "%{$item_color}%");
        }

        if(!empty($buyer_season_id)){
            $search_result = $search_result->where('purchase_order_details.item_description', 'LIKE', "%{$item_description}%");
        }

        return $search_result;
    }
}
