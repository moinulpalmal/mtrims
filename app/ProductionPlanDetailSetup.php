<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class ProductionPlanDetailSetup extends Model
{
    public static function activeProductionPlanList($lpd, $date){
        if($lpd == -1){
            return ProductionPlanDetailSetup::orderBy('production_date', 'ASC')
                ->join('purchase_order_masters', 'purchase_order_masters.id', '=', 'production_plan_detail_setups.purchase_order_master_id')
                ->select('production_plan_detail_setups.purchase_order_master_id', 'purchase_order_masters.lpd',
                    'production_plan_detail_setups.purchase_order_detail_id', 'production_plan_detail_setups.machine_id',
                    'production_plan_detail_setups.delivery_location_id', 'production_plan_detail_setups.no_of_heads', 'production_plan_detail_setups.achievement_production',
                    'production_plan_detail_setups.item_unit_id', 'production_plan_detail_setups.id', 'production_plan_detail_setups.production_date',
                    'production_plan_detail_setups.target_production', 'production_plan_detail_setups.status', 'production_plan_detail_setups.left_over_production' )
                ->where('production_plan_detail_setups.status', 'A')
                ->where('production_date', $date)
                ->get();
        }else{
            return ProductionPlanDetailSetup::orderBy('production_date', 'ASC')
                ->join('purchase_order_masters', 'purchase_order_masters.id', '=', 'production_plan_detail_setups.purchase_order_master_id')
                ->select('production_plan_detail_setups.purchase_order_master_id', 'purchase_order_masters.lpd',
                    'production_plan_detail_setups.purchase_order_detail_id', 'production_plan_detail_setups.machine_id',
                    'production_plan_detail_setups.delivery_location_id', 'production_plan_detail_setups.no_of_heads', 'production_plan_detail_setups.achievement_production',
                    'production_plan_detail_setups.item_unit_id', 'production_plan_detail_setups.id', 'production_plan_detail_setups.production_date',
                    'production_plan_detail_setups.target_production', 'production_plan_detail_setups.status', 'production_plan_detail_setups.left_over_production' )
                ->where('production_plan_detail_setups.status', 'A')
                ->where('production_date', $date)
                ->where('purchase_order_masters.lpd', $lpd)
                ->get();
        }

    }

    public static function activeProductionPlanListLPD($lpd){
       // echo $lpd;
        if($lpd == -1){
            return ProductionPlanDetailSetup::orderBy('production_date', 'ASC')
                ->join('purchase_order_masters', 'purchase_order_masters.id', '=', 'production_plan_detail_setups.purchase_order_master_id')
                ->select('production_plan_detail_setups.purchase_order_master_id', 'purchase_order_masters.lpd',
                    'production_plan_detail_setups.purchase_order_detail_id', 'production_plan_detail_setups.machine_id',
                    'production_plan_detail_setups.delivery_location_id', 'production_plan_detail_setups.no_of_heads',
                    'production_plan_detail_setups.item_unit_id', 'production_plan_detail_setups.id',
                    'production_plan_detail_setups.target_production', 'production_plan_detail_setups.status' )
                ->where('production_plan_detail_setups.status', 'A')
                ->get();
        }
        else{
            return ProductionPlanDetailSetup::orderBy('production_date', 'ASC')
                ->join('purchase_order_masters', 'purchase_order_masters.id', '=', 'production_plan_detail_setups.purchase_order_master_id')
                ->select('production_plan_detail_setups.purchase_order_master_id', 'purchase_order_masters.lpd',
                    'production_plan_detail_setups.purchase_order_detail_id', 'production_plan_detail_setups.machine_id',
                    'production_plan_detail_setups.delivery_location_id', 'production_plan_detail_setups.no_of_heads',
                    'production_plan_detail_setups.item_unit_id', 'production_plan_detail_setups.id',
                    'production_plan_detail_setups.target_production', 'production_plan_detail_setups.status' )
                ->where('production_plan_detail_setups.status', 'A')
                ->where('purchase_order_masters.lpd', $lpd)
                ->get();
        }

    }
    public static function runningMachineCount($productionPlanMasterId){
        return DB::table('production_plan_detail_setups')
            ->where('production_plan_master_id', $productionPlanMasterId)
            ->where('status', '!=', 'D')
            ->distinct()
            ->count('machine_id');
    }

    public static function runningMachineCountSectionSetup($productionPlanMasterId, $sectionSetupId){
        return DB::table('production_plan_detail_setups')
            ->join('purchase_order_masters', 'production_plan_detail_setups.purchase_order_master_id', '=', 'purchase_order_masters.id')
            ->join('machine_setups', 'machine_setups.id', '=', 'production_plan_detail_setups.machine_id')
            ->where('production_plan_detail_setups.production_plan_master_id', $productionPlanMasterId)
            ->where('production_plan_detail_setups.status', '!=', 'D')
            ->where('machine_setups.section_setup_id', $sectionSetupId)
            ->distinct()
            ->count('production_plan_detail_setups.machine_id');
    }


    public static function totalProductionCount($productionPlanMasterId){
        return DB::table('production_plan_detail_setups')
            ->where('production_plan_master_id', $productionPlanMasterId)
            ->where('status', '!=', 'D')
            ->selectRaw('SUM(target_production) AS total_target_production')
            ->selectRaw('SUM(achievement_production) AS total_achievement_production')
            ->selectRaw('SUM(target_production-achievement_production) AS total_variation_production')
            ->first();

    }

    public static function totalProductionCountSectionSetup($productionPlanMasterId , $sectionId){
        return DB::table('production_plan_detail_setups')
            ->join('purchase_order_masters', 'production_plan_detail_setups.purchase_order_master_id', '=', 'purchase_order_masters.id')
            ->join('machine_setups', 'machine_setups.id', '=', 'production_plan_detail_setups.machine_id')
            ->where('production_plan_detail_setups.production_plan_master_id', $productionPlanMasterId)
            ->where('production_plan_detail_setups.status', '!=', 'D')
            ->where('machine_setups.section_setup_id', $sectionId)
            ->selectRaw('SUM(production_plan_detail_setups.target_production) AS total_target_production')
            ->selectRaw('SUM(production_plan_detail_setups.achievement_production) AS total_achievement_production')
            ->selectRaw('SUM(production_plan_detail_setups.target_production-production_plan_detail_setups.achievement_production) AS total_variation_production')
            ->first();

    }

    public static function totalRevenue($productionPlanMasterId){

        $sql = "SELECT production_plan_detail_setups.production_plan_master_id,
                SUM(production_plan_detail_setups.achievement_production * purchase_order_details.gross_unit_price) AS total_revenue
                FROM production_plan_detail_setups
                INNER JOIN purchase_order_details ON purchase_order_details.purchase_order_master_id = production_plan_detail_setups.purchase_order_master_id
                AND purchase_order_details.item_count = production_plan_detail_setups.purchase_order_detail_id
                WHERE production_plan_detail_setups.production_plan_master_id = '$productionPlanMasterId'
                GROUP BY production_plan_detail_setups.production_plan_master_id";

        return DB::select(DB::raw($sql));
    }

    public static function totalRevenueDateFrame($from_date, $to_date){

        $sql = "SELECT
                SUM(production_plan_detail_setups.achievement_production * purchase_order_details.gross_unit_price) AS total_revenue
                FROM production_plan_detail_setups
                INNER JOIN purchase_order_details ON purchase_order_details.purchase_order_master_id = production_plan_detail_setups.purchase_order_master_id
                AND purchase_order_details.item_count = production_plan_detail_setups.purchase_order_detail_id
                WHERE production_plan_detail_setups.production_date BETWEEN '$from_date' AND '$to_date'
                GROUP BY production_plan_detail_setups.achievement_production, purchase_order_details.gross_unit_price";

        return DB::select(DB::raw($sql));
    }

    public static function totalMachineCostDateFrame($from_date, $to_date){

        $sql = "SELECT SUM(machine_cost_in_usd) AS total_machine_cost FROM production_plan_master_setups
                WHERE production_date BETWEEN '$from_date' AND '$to_date' GROUP BY machine_cost_in_usd";

        return DB::select(DB::raw($sql));
    }

    public static function totalMaterialCostDateFrame($from_date, $to_date){

        $sql = "SELECT SUM(material_cost_in_usd) AS total_material_cost FROM production_plan_master_setups
                WHERE production_date BETWEEN '$from_date' AND '$to_date' GROUP BY material_cost_in_usd";

        return DB::select(DB::raw($sql));
    }

}
