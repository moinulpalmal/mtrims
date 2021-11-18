<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class PurchaseOrderDetail extends Model
{
    //

    public function purchase_order_master() {
        return $this->belongsTo('PurchaseOrderMaster');
    }

    public static function getPurchaseOrderListByLPDForPlanning($lpd, $myTodayDate){
        return DB::table('purchase_order_details')
            ->join('purchase_order_masters', 'purchase_order_details.purchase_order_master_id', '=', 'purchase_order_masters.id')
            ->join('units', 'purchase_order_details.item_unit_id', '=', 'units.id')
            ->join('trims_types', 'purchase_order_details.trims_type_id', '=', 'trims_types.id')
            ->join('buyers', 'purchase_order_masters.buyer_id', '=', 'buyers.id')
            ->select('purchase_order_masters.lpd_po_no', 'buyers.name AS buyer_name', 'purchase_order_masters.lpd',
                'purchase_order_masters.id AS POM_ID', 'purchase_order_details.item_color',
                'purchase_order_details.item_description', 'purchase_order_details.style_no', 'purchase_order_details.status',
                'purchase_order_details.item_count AS POD_ID', 'purchase_order_details.item_size',
                'trims_types.name AS trims_type_name', 'trims_types.section_setup_id','units.short_unit', 'purchase_order_masters.production_start_date'
                , 'purchase_order_details.trims_type_id', 'purchase_order_masters.production_end_date')
//            ->selectRaw('(purchase_order_details.item_order_quantity-purchase_order_details.finished_quantity) AS not_finished_quantity')
            ->where('purchase_order_masters.status', 'A')
            ->where('purchase_order_details.status', 'A')
            ->where('purchase_order_masters.lpd', $lpd)
            ->whereDate('purchase_order_masters.production_start_date', '<=', $myTodayDate)
            ->get();
    }

    public static function getPurchaseOrderListByAllForPlanning($myTodayDate){
        return DB::table('purchase_order_details')
            ->join('purchase_order_masters', 'purchase_order_details.purchase_order_master_id', '=', 'purchase_order_masters.id')
            ->join('units', 'purchase_order_details.item_unit_id', '=', 'units.id')
            ->join('trims_types', 'purchase_order_details.trims_type_id', '=', 'trims_types.id')
            ->join('buyers', 'purchase_order_masters.buyer_id', '=', 'buyers.id')
            ->select('purchase_order_masters.lpd_po_no', 'buyers.name AS buyer_name', 'purchase_order_masters.lpd',
                'purchase_order_masters.id AS POM_ID', 'purchase_order_details.item_color',
                'purchase_order_details.item_description', 'purchase_order_details.style_no', 'purchase_order_details.status',
                'purchase_order_details.item_count AS POD_ID', 'purchase_order_details.item_size',
                'trims_types.name AS trims_type_name', 'trims_types.section_setup_id','units.short_unit', 'purchase_order_masters.production_start_date'
                , 'purchase_order_details.trims_type_id', 'purchase_order_masters.production_end_date')
//            ->selectRaw('(purchase_order_details.item_order_quantity-purchase_order_details.finished_quantity) AS not_finished_quantity')
            ->where('purchase_order_masters.status', 'A')
            ->where('purchase_order_details.status', 'A')
            ->whereDate('purchase_order_masters.production_start_date', '<=', $myTodayDate)
            ->get();
    }

}
