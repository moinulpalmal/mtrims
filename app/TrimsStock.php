<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class TrimsStock extends Model
{
    public static function getPOProductStockByPOID($purchase_order_master_id)
    {
        return DB::table('trims_stocks')
            ->join('purchase_order_masters', 'trims_stocks.purchase_order_master_id', '=', 'purchase_order_masters.id')
            ->join('purchase_order_details', function ($join) {
                $join->on('purchase_order_details.item_count', '=', 'trims_stocks.purchase_order_detail_id');
                $join->on('purchase_order_details.purchase_order_master_id', '=', 'trims_stocks.purchase_order_master_id');
            })
            ->join('trims_stock_delivery_sum', 'trims_stock_delivery_sum.trims_stock_id', '=', 'trims_stocks.id')
            ->join('buyers', 'purchase_order_masters.buyer_id', '=', 'buyers.id')
            ->join('trims_types', 'purchase_order_details.trims_type_id', '=', 'trims_types.id')
            ->join('units', 'purchase_order_details.item_unit_id', '=', 'units.id')
            ->select('purchase_order_masters.lpd', 'trims_stocks.stock_quantity', 'trims_stocks.delivered_quantity',
                'purchase_order_masters.lpd_po_no', 'purchase_order_details.style_no','buyers.name AS buyer', 'trims_stocks.status', 'trims_stocks.is_free_stock',
                'purchase_order_details.item_size', 'purchase_order_details.item_color', 'purchase_order_details.item_description',  'trims_stocks.id',
                'units.short_unit', 'trims_types.name AS trims_type',
                'trims_stock_delivery_sum.total_delivered_quantity', 'trims_stock_delivery_sum.received_quantity')
            ->where('trims_stocks.status', '!=','D')
            ->where('purchase_order_masters.id', $purchase_order_master_id)
            ->get();

    }

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
