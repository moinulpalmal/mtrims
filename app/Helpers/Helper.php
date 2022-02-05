<?php
namespace App\Helpers;
use App\DeliveryDetailReplace;
use App\MachineSetup;
use App\ProductionPlanDetailSetup;
use Illuminate\Support\Facades\DB;

class Helper{
   public static function IDwiseData($table_name,$field_name,$Id)
   {
   	 return DB::table($table_name)->where($field_name,$Id)->first();
   }

    public static function TwoIDWiseData($table_name,$field_name,$Id,$field_name_twp,$Id_Two)
    {
        return DB::table($table_name)->where($field_name,$Id)->where($field_name_twp,$Id_Two)->first();
    }

    public static function TwoIDWiseDataList($table_name,$field_name,$Id,$field_name_twp,$Id_Two)
    {
        return DB::table($table_name)->where($field_name,$Id)->where($field_name_twp,$Id_Two)->get();
    }

    public static function ThreeIDWiseData($table_name,$field_name,$Id,$field_name_two,$Id_Two, $field_name_three,$Id_Three)
    {
        return DB::table($table_name)
            ->where($field_name,$Id)
            ->where($field_name_two,$Id_Two)
            ->where($field_name_three,$Id_Three)
            ->first();
    }

  /* public static function delete($table_name,$table_ID,$ID_value)
   {
      DB::table($table_name)
      ->where($table_ID, $ID_value)
      ->delete();

      return;
   }*/

   public static function StockIDBasedOnPO($master_id, $detail_id){
       $getStock = DB::table('trims_stocks')
           ->select('trims_stocks.id')
           ->where('trims_stocks.status', '!=','D')
           ->where('trims_stocks.purchase_order_master_id', $master_id)
           ->where('trims_stocks.purchase_order_detail_id', $detail_id)
           ->first();

       if($getStock != null){
            return $getStock->id;
       }

       return 0;
   }

   public static function GetCurrentTrimsStock($stockID){
       $getStock = DB::table('trims_stocks')
           ->select('trims_stocks.stock_quantity')
           ->where('trims_stocks.status', '!=','D')
           ->where('trims_stocks.id', $stockID)
           ->first();

       if($getStock != null){
           return $getStock->stock_quantity;
       }

       return 0;
   }

    public static function GetCurrentLeftOverTrimsStock($stockID){
        $getStock = DB::table('left_over_trims_stocks')
            ->select('left_over_trims_stocks.stock_quantity')
            ->where('left_over_trims_stocks.status', '!=','D')
            ->where('left_over_trims_stocks.id', $stockID)
            ->first();

        if($getStock != null){
            return $getStock->stock_quantity;
        }

        return 0;
    }

 public static function stockGrossDeliveredQtyTotal($stockID){
        $deliveryQty = DB::table('delivery_details')
            ->join('delivery_masters', 'delivery_details.delivery_master_id', '=', 'delivery_masters.id')
            ->where('delivery_masters.status', '!=','D')
            ->where('delivery_details.trims_stock_id', $stockID)
            ->sum('delivery_details.gross_delivered_quantity');

        return $deliveryQty;
 }

    public static function stockGrossDeliveredQtyNotApproved($stockID){
        $deliveryQty = DB::table('delivery_details')
            ->join('delivery_masters', 'delivery_details.delivery_master_id', '=', 'delivery_masters.id')
            ->where('delivery_masters.status', 'A')
            ->where('delivery_details.trims_stock_id', $stockID)
            ->sum('delivery_details.gross_delivered_quantity');

        return $deliveryQty;
    }

    public static function stockGrossDeliveredQtyApproved($stockID){
        $deliveryQty = DB::table('delivery_details')
            ->join('delivery_masters', 'delivery_details.delivery_master_id', '=', 'delivery_masters.id')
            ->where('delivery_masters.status', 'AP')
            ->where('delivery_details.trims_stock_id', $stockID)
            ->sum('delivery_details.gross_delivered_quantity');

        return $deliveryQty;
    }

   public static function GetSuggestedProductionQuantity($master_id, $detail_id){
       $orderQuantity = DB::table('purchase_order_details')
           ->where('purchase_order_details.status', '!=','D')
           ->where('purchase_order_details.purchase_order_master_id', $master_id)
           ->where('purchase_order_details.item_count', $detail_id)
           ->sum('purchase_order_details.item_order_quantity');

       $targetProductionActive = DB::table('production_plan_detail_setups')
           ->where('production_plan_detail_setups.status', 'A')
           ->where('production_plan_detail_setups.purchase_order_master_id', $master_id)
           ->where('production_plan_detail_setups.purchase_order_detail_id', $detail_id)
           ->sum('production_plan_detail_setups.target_production');

       $productionAchievement = DB::table('production_plan_detail_setups')
           ->where('production_plan_detail_setups.status', '=','PC')
           ->where('production_plan_detail_setups.purchase_order_master_id', $master_id)
           ->where('production_plan_detail_setups.purchase_order_detail_id', $detail_id)
           ->sum('production_plan_detail_setups.achievement_production');

       $replacementQty = (float)DeliveryDetailReplace::getTotalReplacementProductionQtyForPlan($master_id, $detail_id);
       //$replacmentQty = 0;
       return ($orderQuantity - $targetProductionActive - $productionAchievement + $replacementQty);
   }

   public static function GetTotalOrderQuantityMaster($master_id){
       $orderQuantity = DB::table('purchase_order_details')
           ->where('purchase_order_details.status', '!=','D')
           ->where('purchase_order_details.purchase_order_master_id', $master_id)
           ->sum('purchase_order_details.item_order_quantity');

       return $orderQuantity;
   }

   public static function GetSuggestedProductionQuantityMaster($master_id){
       $orderQuantity = DB::table('purchase_order_details')
           ->where('purchase_order_details.status', '!=','D')
           ->where('purchase_order_details.purchase_order_master_id', $master_id)
           ->sum('purchase_order_details.item_order_quantity');

       $targetProductionActive = DB::table('production_plan_detail_setups')
           ->where('production_plan_detail_setups.status', 'A')
           ->where('production_plan_detail_setups.purchase_order_master_id', $master_id)
           ->sum('production_plan_detail_setups.target_production');

       $productionAchievement = DB::table('production_plan_detail_setups')
           ->where('production_plan_detail_setups.status', '=','PC')
           ->where('production_plan_detail_setups.purchase_order_master_id', $master_id)
           ->sum('production_plan_detail_setups.achievement_production');

       $replacmentQty = (float)DeliveryDetailReplace::getTotalReplacementProductionQtyForPlanMaster($master_id);

       return ($orderQuantity - $targetProductionActive - $productionAchievement + $replacmentQty);
   }

   public static function GetTotalOrderQuantity($master_id, $detail_id){
       $orderQuantity = DB::table('purchase_order_details')
           ->where('purchase_order_details.status', '!=','D')
           ->where('purchase_order_details.purchase_order_master_id', $master_id)
           ->where('purchase_order_details.item_count', $detail_id)
           ->sum('purchase_order_details.item_order_quantity');

       return $orderQuantity;
   }

   public static function GetTotalActiveProductionQuantity($master_id, $detail_id){
       $targetProductionActive = DB::table('production_plan_detail_setups')
           ->where('production_plan_detail_setups.status', 'PC')
           ->where('production_plan_detail_setups.purchase_order_master_id', $master_id)
           ->where('production_plan_detail_setups.purchase_order_detail_id', $detail_id)
           ->sum('production_plan_detail_setups.target_production');

       return $targetProductionActive;
   }

   /* public static function GetTotalActiveProductionQuantity($master_id, $detail_id){
        $targetProductionActive = DB::table('production_plan_detail_setups')
            ->where('production_plan_detail_setups.status', 'A')
            ->where('production_plan_detail_setups.purchase_order_master_id', $master_id)
            ->where('production_plan_detail_setups.purchase_order_detail_id', $detail_id)
            ->sum('production_plan_detail_setups.target_production');

        return $targetProductionActive;
    }*/

   public static function GetTotalPlannedProduction($master_id, $detail_id){
       $targetProductionTotal = DB::table('production_plan_detail_setups')
           ->where('production_plan_detail_setups.status', '!=','D')
           ->where('production_plan_detail_setups.purchase_order_master_id', $master_id)
           ->where('production_plan_detail_setups.purchase_order_detail_id', $detail_id)
           ->sum('production_plan_detail_setups.target_production');

       return $targetProductionTotal;
   }
   public static function GetAchievementProductionQuantity($master_id, $detail_id){
        $productionAchievement = DB::table('production_plan_detail_setups')
            ->where('production_plan_detail_setups.status', '!=','D')
            ->where('production_plan_detail_setups.purchase_order_master_id', $master_id)
            ->where('production_plan_detail_setups.purchase_order_detail_id', $detail_id)
            ->sum('production_plan_detail_setups.achievement_production');

        return $productionAchievement;
   }

    public static function GetTotalActiveProduction($master_id, $detail_id){

        $production = DB::table('production_plan_detail_setups')
            ->where('production_plan_detail_setups.status', '!=','D')
            ->where('production_plan_detail_setups.purchase_order_master_id', $master_id)
            ->where('production_plan_detail_setups.purchase_order_detail_id', $detail_id)
            ->sum('production_plan_detail_setups.target_production');

        return $production;
    }

    public static function GetFinishedProduction($master_id, $detail_id){
        $productionComplete = DB::table('production_plan_detail_setups')
            ->where('production_plan_detail_setups.status', '!=','PC')
            ->where('production_plan_detail_setups.purchase_order_master_id', $master_id)
            ->where('production_plan_detail_setups.purchase_order_detail_id', $detail_id)
            ->sum('production_plan_detail_setups.achievement_production');

        return $productionComplete;
    }

    public static function GetDeliveredQuantity($master_id, $detail_id){
        $productionDelivered = DB::table('production_plan_detail_setups')
            ->where('production_plan_detail_setups.status', '!=','D')
            ->where('production_plan_detail_setups.purchase_order_master_id', $master_id)
            ->where('production_plan_detail_setups.purchase_order_detail_id', $detail_id)
            ->sum('production_plan_detail_setups.delivered_production');

        return $productionDelivered;
    }

    public static function GetStockQuantity($master_id, $detail_id){
        $productionDelivered = DB::table('production_plan_detail_setups')
            ->where('production_plan_detail_setups.status', '!=','D')
            ->where('production_plan_detail_setups.purchase_order_master_id', $master_id)
            ->where('production_plan_detail_setups.purchase_order_detail_id', $detail_id)
            ->sum('production_plan_detail_setups.delivered_production');

        $productionComplete = DB::table('production_plan_detail_setups')
            ->where('production_plan_detail_setups.status', '!=','PC')
            ->where('production_plan_detail_setups.purchase_order_master_id', $master_id)
            ->where('production_plan_detail_setups.purchase_order_detail_id', $detail_id)
            ->sum('production_plan_detail_setups.achievement_production');

        return ($productionComplete-$productionDelivered);
    }

  /* public static function GetProductionRevenue($master_id, $detail_id){
       $revenue = DB::table('production_plan_detail_setups')
           ->join('purchase_order_details',function($join){
               $join->on('purchase_order_details.purchase_order_master_id','=','production_plan_detail_setups.purchase_order_master_id')
                   ->on('purchase_order_details.item_count','=','production_plan_detail_setups.purchase_order_detail_id');
           })
           ->where('production_plan_detail_setups.status', 'PC')
           ->where('production_plan_detail_setups.purchase_order_master_id', $master_id)
           ->where('production_plan_detail_setups.purchase_order_detail_id', $detail_id)
           ->sum('production_plan_detail_setups.achievement_production * purchase_order_details.unit_price_in_usd');

       return $revenue;
   }*/

   public static function GetTotalActiveMachineCount(){
       return MachineSetup::getActiveMachineCount();
   }

    public static function GetTotalActiveMachineCountSectionSetup($sectionID){
        return MachineSetup::getActiveMachineCountSectionSetup($sectionID);
    }

    public static function GetTotalRunningMachineCount($planMasterId){
       return ProductionPlanDetailSetup::runningMachineCount($planMasterId);
    }

    public static function GetTotalIdleMachineCount($planMasterId){
        return (MachineSetup::getActiveMachineCount()-ProductionPlanDetailSetup::runningMachineCount($planMasterId));
    }

    public static function GetTotalRunningMachineCountSectionSetup($planMasterId, $sectionID){
        return ProductionPlanDetailSetup::runningMachineCountSectionSetup($planMasterId, $sectionID);
    }

    public static function GetTotalProductionCount($productionPlanMasterId){
       return ProductionPlanDetailSetup::totalProductionCount($productionPlanMasterId);
    }

    public static function GetTotalProductionCountSectionSetup($productionPlanMasterId, $sectionID){
        return ProductionPlanDetailSetup::totalProductionCountSectionSetup($productionPlanMasterId, $sectionID);
    }

    public static function GetTotalProductionRevenue($productionPlanMasterId){
        return ProductionPlanDetailSetup::totalRevenue($productionPlanMasterId);
    }

    public static function GetTotalProductionRevenueDate($from_date, $to_date){
        return ProductionPlanDetailSetup::totalRevenueDateFrame($from_date, $to_date);
    }

    public static function GetTotalMachineCostDate($from_date, $to_date){
        return ProductionPlanDetailSetup::totalMachineCostDateFrame($from_date, $to_date);
    }

    public static function GetTotalMaterialCostDate($from_date, $to_date){
        return ProductionPlanDetailSetup::totalMaterialCostDateFrame($from_date, $to_date);
    }

}
