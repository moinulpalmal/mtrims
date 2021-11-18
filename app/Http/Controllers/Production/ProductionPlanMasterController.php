<?php

namespace App\Http\Controllers\Production;

use App\Helpers\Helper;
use App\Http\Controllers\Controller;
use App\ProductionPlanDetailSetup;
use App\ProductionPlanMasterSetup;
use App\SectionSetup;
use App\TrimsType;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class ProductionPlanMasterController extends Controller
{
        public function index(){
            $productionPlans = ProductionPlanMasterSetup::orderBy('production_date', 'DESC')
                ->where('status', '!=', 'D')
                ->take(365)
                ->get();

            return view('production.daily.index', compact('productionPlans'));
        }

        public function savePlan(Request $request){
            $productionPlan = ProductionPlanMasterSetup::find($request->id);

            $productionPlan->machine_cost_in_usd = $request->machine_cost_in_usd;
            $productionPlan->material_cost_in_usd = $request->material_cost_in_usd;
            $productionPlan->total_machine = 0;
            $productionPlan->total_running_machine = 0;
            $productionPlan->remarks = $request->remarks;
            $productionPlan->updated_by = Auth::id();

            if($productionPlan->save()){
                return 'success';
            }

            return 'Error';
        }

        public function editPlan(Request $request){
            $productionPlan = ProductionPlanMasterSetup::find($request->id);

            if($productionPlan != null){
                $buyerData = array(
                    'machine_cost_in_usd' => $productionPlan->machine_cost_in_usd,
                    'material_cost_in_usd' => $productionPlan->material_cost_in_usd,
                    'production_date' => $productionPlan->production_date,
                    'remarks' => $productionPlan->remarks,
                    'id' => $productionPlan->id
                );
                return $buyerData;
            }
            return 'Error';
        }

        public function achievementReport($id){

          /*  $result = DB::table('production_plan_detail_setups')
                ->join('purchase_order_masters', 'production_plan_detail_setups.purchase_order_master_id', '=', 'purchase_order_masters.id')
                ->join('machine_setups', 'machine_setups.id', '=', 'production_plan_detail_setups.machine_id')
                ->where('production_plan_detail_setups.production_plan_master_id', $id)
                ->where('production_plan_detail_setups.status', '!=', 'D')
                ->where('machine_setups.section_setup_id', 2)
                ->selectRaw('SUM(production_plan_detail_setups.target_production) AS total_target_production')
                ->selectRaw('SUM(production_plan_detail_setups.achievement_production) AS total_achievement_production')
                ->selectRaw('SUM(production_plan_detail_setups.target_production-production_plan_detail_setups.achievement_production) AS total_variation_production')
                ->get();

            return $result;*/

           /* return DB::table('production_plan_detail_setups')
                ->join('purchase_order_masters', 'production_plan_detail_setups.purchase_order_master_id', '=', 'purchase_order_masters.id')
                ->join('machine_setups', 'machine_setups.id', '=', 'production_plan_detail_setups.machine_id')
                ->where('production_plan_detail_setups.production_plan_master_id', 3)
                ->where('production_plan_detail_setups.status', '!=', 'D')
                ->where('machine_setups.section_setup_id', 2)
                ->distinct()
                ->count('production_plan_detail_setups.machine_id');*/

            $productionPlanMaster = ProductionPlanMasterSetup::find($id);
            if($productionPlanMaster != null){
                //$trimsTypes = TrimsType::orderBy('name')->where('status','!=', 'D')->get();
                $sectionSetups = SectionSetup::orderBy('name')->where('status','!=', 'D')->get();
                $productionPlanDetails = ProductionPlanDetailSetup::where('production_plan_master_id', $id)
                    ->where('status', '!=', 'D')
                    ->get();

                //return Helper::GetTotalProductionRevenue($productionPlanMaster->id)[0]->total_revenue;
                //return ProductionPlanDetailSetup::totalRevenue($id);

                return view('production.daily.achievement-print-view', compact('productionPlanMaster',
                    'productionPlanDetails', /*'trimsTypes',*/ 'sectionSetups'));
            }
            else{
                return redirect()->route('production.plan.daily.master');
            }
        }

    public function planReport($id){
        $productionPlanMaster = ProductionPlanMasterSetup::find($id);

        if($productionPlanMaster != null){
           // $trimsTypes = TrimsType::orderBy('name')->where('status','!=', 'D')->get();
            $sectionSetups = SectionSetup::orderBy('name')->where('status','!=', 'D')->get();
            $productionPlanDetails = ProductionPlanDetailSetup::where('production_plan_master_id', $id)
                ->where('status', '!=', 'D')
                ->get();

            //return Helper::GetTotalProductionRevenue($productionPlanMaster->id)[0]->total_revenue;
            //return ProductionPlanDetailSetup::totalRevenue($id);

            return view('production.daily.plan-print-view', compact('productionPlanMaster',
                'productionPlanDetails', /*'trimsTypes',*/ 'sectionSetups'));
        }
        else{
            return redirect()->route('production.plan.daily.master');
        }
    }
}
