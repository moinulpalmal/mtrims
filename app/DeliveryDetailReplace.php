<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class DeliveryDetailReplace extends Model
{
    public static function getRePlacementItemList($delivery_master_id){
        $replaceDetails = DeliveryDetailReplace::orderBy('id')
                        ->where('status', '!=', 'D')
                        ->where('delivery_master_id', $delivery_master_id)
                        ->get();

        return $replaceDetails;
    }

    public static function getTotalReplacementRequestQty($delivery_master_id, $delivery_detail_id){
            $quantity = DB::table('delivery_detail_replaces')
                ->where('delivery_detail_replaces.status', 'I')
                ->where('delivery_detail_replaces.delivery_master_id', $delivery_master_id)
                ->where('delivery_detail_replaces.delivery_detail_id', $delivery_detail_id)
                ->sum('delivery_detail_replaces.requested_replace_quantity');

            return $quantity;
    }

    public static function getTotalReplacementStoredQty($delivery_master_id, $delivery_detail_id){
        $quantity = DB::table('delivery_detail_replaces')
            ->where('delivery_detail_replaces.status', 'A')
            ->where('delivery_detail_replaces.delivery_master_id', $delivery_master_id)
            ->where('delivery_detail_replaces.delivery_detail_id', $delivery_detail_id)
            ->sum('delivery_detail_replaces.stored_quantity');

        return $quantity;
    }

    public static function getTotalReplacementProductionQty($delivery_master_id, $delivery_detail_id){
        $quantity = DB::table('delivery_detail_replaces')
            ->where('delivery_detail_replaces.status', 'A')
            ->where('delivery_detail_replaces.delivery_master_id', $delivery_master_id)
            ->where('delivery_detail_replaces.delivery_detail_id', $delivery_detail_id)
            ->sum('delivery_detail_replaces.production_replace_quantity');

        return $quantity;
    }

    public static function getTotalReplacementProductionQtyForPlan($purchase_order_master_id, $purchase_order_detail_id){
        $quantity = DB::table('view_delivery_replace_details')
            ->where('view_delivery_replace_details.status', 'A')
            ->where('view_delivery_replace_details.purchase_order_master_id', $purchase_order_master_id)
            ->where('view_delivery_replace_details.purchase_order_detail_id', $purchase_order_detail_id)
            ->sum('view_delivery_replace_details.actual_production_replace_quantity');

        return $quantity;
    }

    public static function getTotalReplacementProductionQtyForPlanMaster($purchase_order_master_id){
        $quantity = DB::table('view_delivery_replace_details')
            ->where('view_delivery_replace_details.status', 'A')
            ->where('view_delivery_replace_details.purchase_order_master_id', $purchase_order_master_id)
            ->sum('view_delivery_replace_details.actual_production_replace_quantity');

        return $quantity;
    }

    public static function getTotalReplacementNonProductionQty($delivery_master_id, $delivery_detail_id){
        $quantity = DB::table('delivery_detail_replaces')
            ->where('view_delivery_replace_details.status', 'A')
            ->where('delivery_detail_replaces.delivery_master_id', $delivery_master_id)
            ->where('delivery_detail_replaces.delivery_detail_id', $delivery_detail_id)
            ->sum('delivery_detail_replaces.non_production_replace_quantity');
        return $quantity;
    }

    public static function getSuggestedReplacementQty($delivery_master_id, $delivery_detail_id){
        $requested_replace_quantity = DB::table('delivery_detail_replaces')
            ->where('delivery_detail_replaces.status', '!=','D')
            ->where('delivery_detail_replaces.status', '!=','R')
            ->where('delivery_detail_replaces.delivery_master_id', $delivery_master_id)
            ->where('delivery_detail_replaces.delivery_detail_id', $delivery_detail_id)
            ->sum('delivery_detail_replaces.requested_replace_quantity');

        $delivery_qty = DB::table('delivery_details')
            ->where('delivery_details.delivery_master_id', $delivery_master_id)
            ->where('delivery_details.item_count', $delivery_detail_id)
            ->sum('delivery_details.delivered_quantity');

        return ($delivery_qty - $requested_replace_quantity);
    }



}
