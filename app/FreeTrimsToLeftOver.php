<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class FreeTrimsToLeftOver extends Model
{
    public static function getRequestedList(){
        return DB::table('free_trims_to_left_overs')
            ->join('free_trims_stocks', 'free_trims_stocks.id', '=', 'free_trims_to_left_overs.free_trims_stock_id')
            ->join('purchase_order_masters', 'free_trims_stocks.purchase_order_master_id', '=', 'purchase_order_masters.id')
            ->join('purchase_order_details', function ($join) {
                $join->on('purchase_order_details.item_count', '=', 'free_trims_stocks.purchase_order_detail_id');
                $join->on('purchase_order_details.purchase_order_master_id', '=', 'free_trims_stocks.purchase_order_master_id');
            })
            ->join('buyers', 'purchase_order_masters.buyer_id', '=', 'buyers.id')
            ->join('trims_types', 'purchase_order_details.trims_type_id', '=', 'trims_types.id')
            ->join('units', 'purchase_order_details.item_unit_id', '=', 'units.id')
            ->select('purchase_order_masters.lpd', 'free_trims_to_left_overs.requested_left_over_quantity', 'free_trims_to_left_overs.left_over_reason',
                'purchase_order_masters.lpd_po_no', 'purchase_order_details.style_no','buyers.name AS buyer', 'free_trims_to_left_overs.id',
                'purchase_order_details.item_size', 'purchase_order_details.item_color', 'purchase_order_details.item_description', 'free_trims_to_left_overs.remarks',
                'units.short_unit', 'trims_types.name AS trims_type', 'free_trims_to_left_overs.status')
            ->where('free_trims_to_left_overs.status', 'I')
            ->get();
    }
}
