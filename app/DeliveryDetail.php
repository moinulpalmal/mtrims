<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class DeliveryDetail extends Model
{
    public static function getPOProductApprovedByPOID($purchase_order_master_id)
    {
        return DB::table('delivery_details')
            ->join('delivery_masters', 'delivery_masters.id', '=', 'delivery_details.delivery_master_id')
            ->join('purchase_order_details', function ($join) {
                $join->on('purchase_order_details.item_count', '=', 'delivery_details.purchase_order_detail_id');
                $join->on('purchase_order_details.purchase_order_master_id', '=', 'delivery_masters.purchase_order_master_id');
            })
            ->join('trims_types', 'trims_types.id', '=', 'purchase_order_details.trims_type_id')
            ->join('purchase_order_masters', 'purchase_order_details.purchase_order_master_id', '=', 'purchase_order_masters.id')
            ->join('units', 'purchase_order_details.item_unit_id', '=', 'units.id')
            ->join('stores', 'delivery_masters.store_id', '=', 'stores.id')
            ->select('purchase_order_details.style_no','purchase_order_details.item_size', 'purchase_order_details.item_color', 
                'purchase_order_details.item_description','delivery_masters.challan_date', 'delivery_masters.id AS challan_no', 'delivery_details.remarks',
                'delivery_details.delivered_quantity','delivery_details.gross_delivered_quantity','delivery_details.gross_weight','delivery_details.total_weight',
                'delivery_details.gross_unit','units.short_unit','trims_types.name AS trims_type_name', 'stores.name AS store_name')
            ->where('delivery_masters.status', 'AP')
            ->where('purchase_order_masters.id', $purchase_order_master_id)
            ->orderBy('delivery_masters.challan_date')
            ->get();
    }

    public static function getPOProductNotApprovedByPOID($purchase_order_master_id)
    {
        return DB::table('delivery_details')
            ->join('delivery_masters', 'delivery_masters.id', '=', 'delivery_details.delivery_master_id')
            ->join('purchase_order_details', function ($join) {
                $join->on('purchase_order_details.item_count', '=', 'delivery_details.purchase_order_detail_id');
                $join->on('purchase_order_details.purchase_order_master_id', '=', 'delivery_masters.purchase_order_master_id');
            })
            ->join('trims_types', 'trims_types.id', '=', 'purchase_order_details.trims_type_id')
            ->join('purchase_order_masters', 'purchase_order_details.purchase_order_master_id', '=', 'purchase_order_masters.id')
            ->join('units', 'purchase_order_details.item_unit_id', '=', 'units.id')
            ->join('stores', 'delivery_masters.store_id', '=', 'stores.id')
            ->select('purchase_order_details.style_no','purchase_order_details.item_size', 'purchase_order_details.item_color', 
                'purchase_order_details.item_description','delivery_masters.challan_date', 'delivery_masters.id AS challan_no', 'delivery_details.remarks',
                'delivery_details.delivered_quantity','delivery_details.gross_delivered_quantity','delivery_details.gross_weight','delivery_details.total_weight',
                'delivery_details.gross_unit','units.short_unit','trims_types.name AS trims_type_name', 'stores.name AS store_name')
            ->where('delivery_masters.status', 'A')
            ->where('purchase_order_masters.id', $purchase_order_master_id)
            ->orderBy('delivery_masters.challan_date')
            ->get();
    }

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
