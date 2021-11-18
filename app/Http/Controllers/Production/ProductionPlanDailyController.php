<?php

namespace App\Http\Controllers\Production;

use App\Helpers\Helper;
use App\Http\Controllers\Controller;
use App\MachineSetup;
use App\ProductionPlanDetailSetup;
use App\ProductionPlanMasterSetup;
use App\PurchaseOrderDetail;
use App\SectionSetup;
use App\Store;
use App\TrimsType;
use Carbon\Exceptions\BadComparisonUnitException;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class ProductionPlanDailyController extends Controller
{
    public function generatePlan(){

        //$trimsTypes = TrimsType::orderBy('name')->where('status','!=', 'D')->get();
        $machines = MachineSetup::orderBy('name')->where('status', 'A')->get();
        $stores = Store::getActiveStoreListForSelectField();
        $activeProductionPlans = ProductionPlanDetailSetup::where('status', 'A')->get();


        $todayDate = date("Y-m-d");
        $myTodayDate = Carbon::parse($todayDate)
            ->addDays(4)
            ->format('Y-m-d');

        //return $myTodayDate;
        if(Auth::user()->hasTaskPermission('lpdoneproduction', Auth::user()->id)){

            if(Auth::user()->hasTaskPermission('lpdtwoproduction', Auth::user()->id)){
                //return  $purchaseOrderDetails = 12;
                $purchaseOrderDetails = PurchaseOrderDetail::getPurchaseOrderListByAllForPlanning($myTodayDate);
                //return $purchaseOrderDetails;
                return view('production.daily.generate', compact( 'purchaseOrderDetails',
                    'machines', 'stores', 'activeProductionPlans'));
            }
            else{
                $purchaseOrderDetails = PurchaseOrderDetail::getPurchaseOrderListByLPDForPlanning(1, $myTodayDate);

                //$purchaseOrderDetails = $purchaseOrderDetails->where('purchase_order_masters.lpd', 1);
                return view('production.daily.generate', compact( 'purchaseOrderDetails',
                    'machines', 'stores', 'activeProductionPlans'));
            }
        }

        if(Auth::user()->hasTaskPermission('lpdtwoproduction', Auth::user()->id)){
            //return  $purchaseOrderDetails = 2;
            if(Auth::user()->hasTaskPermission('lpdoneproduction', Auth::user()->id)){

                $purchaseOrderDetails = PurchaseOrderDetail::getPurchaseOrderListByAllForPlanning($myTodayDate);
                //return  $purchaseOrderDetails;
                return view('production.daily.generate', compact( 'purchaseOrderDetails',
                    'machines', 'stores', 'activeProductionPlans'));
            }
            else{
                $purchaseOrderDetails = PurchaseOrderDetail::getPurchaseOrderListByLPDForPlanning(2, $myTodayDate);
                //return  $purchaseOrderDetails;
                return view('production.daily.generate', compact( 'purchaseOrderDetails',
                    'machines', 'stores', 'activeProductionPlans'));
            }
        }
    }

    public function saveNewPlan(Request $request){

        $purchaseOrderDetail = PurchaseOrderDetail::where('purchase_order_master_id', $request->purchase_order_master_id)
            ->where('item_count', $request->purchase_order_detail_id)
            ->first();

        $productionPlan = new ProductionPlanDetailSetup();
        $productionPlan->purchase_order_master_id = $request->purchase_order_master_id;
        $productionPlan->purchase_order_detail_id = $request->purchase_order_detail_id;
        $productionPlan->unit_price_in_usd =  $purchaseOrderDetail->gross_unit_price;
        $productionPlan->delivery_location_id =  $request->delivery_location;
        $productionPlan->machine_id =  $request->machine_id;
        $productionPlan->no_of_heads =  $request->no_of_heads;
        $productionPlan->target_production =  $request->target_production;
        $productionPlan->item_unit_id =  $purchaseOrderDetail->item_unit_id;
        $productionPlan->production_date =  $request->production_date;
        $productionPlan->inserted_by =  Auth::id();
        $productionPlan->remarks = $request->remarks;

        if($productionPlan->save()){

            $productPlanSetupMaster = ProductionPlanMasterSetup::where('production_date', $productionPlan->production_date)
                ->where('status','!=', 'D')
                ->first();

            if($productPlanSetupMaster == null){
                $productPlanSetupMasterSetup = new ProductionPlanMasterSetup();
                $productPlanSetupMasterSetup->production_date = $productionPlan->production_date;
                $productPlanSetupMasterSetup->total_machine = 0;
                $productPlanSetupMasterSetup->total_running_machine = 0;
                $productPlanSetupMasterSetup->total_idle_machine = 0;
                $productPlanSetupMasterSetup->inserted_by =  Auth::id();
                $productPlanSetupMasterSetup->save();
                $productionPlan->production_plan_master_id = $productPlanSetupMasterSetup->id;
                $productionPlan->save();
            }
            else{

                $productionPlan->production_plan_master_id = $productPlanSetupMaster->id;
                $productionPlan->updated_by =  Auth::id();
                $productionPlan->save();
            }
            return('success');
        }
        return null;
    }

    public function activePlan(){
        //return  $activeProductionPlans;
       // adadadd
        if(Auth::user()->hasTaskPermission('lpdoneproduction', Auth::user()->id)){
            if(Auth::user()->hasTaskPermission('lpdtwoproduction', Auth::user()->id)){
                //$trimsTypes = TrimsType::orderBy('name')->where('status','!=', 'D')->get();
                $activeProductionPlans = ProductionPlanDetailSetup::activeProductionPlanListLPD(-1);
                $sectionSetups = SectionSetup::orderBy('name')->where('status','!=', 'D')->get();
                $machines = MachineSetup::orderBy('name')->where('status', 'A')->get();
                $stores = Store::orderBy('name')->where('status', 'A')->get();
                //return  $activeProductionPlans;
                return view('production.daily.active', compact('activeProductionPlans',
                    'machines', 'stores', /*'trimsTypes',*/ 'sectionSetups'));
            }
            else{
                $activeProductionPlans = ProductionPlanDetailSetup::activeProductionPlanListLPD(1);
                $sectionSetups = SectionSetup::orderBy('name')->where('status','!=', 'D')->get();
                $machines = MachineSetup::orderBy('name')->where('status', 'A')->get();
                $stores = Store::orderBy('name')->where('status', 'A')->get();
                //$purchaseOrderDetails = $purchaseOrderDetails->where('purchase_order_masters.lpd', 1);
                return view('production.daily.active', compact('activeProductionPlans',
                    'machines', 'stores', /*'trimsTypes',*/ 'sectionSetups'));
            }
        }
        else{

            //return  $purchaseOrderDetails;
            if(Auth::user()->hasTaskPermission('lpdtwoproduction', Auth::user()->id)){
                //return "Bal";
                $activeProductionPlans =  ProductionPlanDetailSetup::activeProductionPlanListLPD(2);
                $sectionSetups = SectionSetup::orderBy('name')->where('status','!=', 'D')->get();
                $machines = MachineSetup::orderBy('name')->where('status', 'A')->get();
                $stores = Store::orderBy('name')->where('status', 'A')->get();
                //return $activeProductionPlans;
                //return  $purchaseOrderDetails;
                return view('production.daily.active', compact('activeProductionPlans',
                    'machines', 'stores', /*'trimsTypes',*/ 'sectionSetups'));
            }
            else{
                $activeProductionPlans =  ProductionPlanDetailSetup::activeProductionPlanListLPD(0);
                $sectionSetups = SectionSetup::orderBy('name')->where('status','!=', 'D')->get();
                $machines = MachineSetup::orderBy('name')->where('status', 'A')->get();
                $stores = Store::orderBy('name')->where('status', 'A')->get();
                return view('production.daily.active', compact('activeProductionPlans',
                    'machines', 'stores', /*'trimsTypes',*/ 'sectionSetups'));
            }
        }
    }

    public function updatePlan(Request $request){
        $productionPlan = ProductionPlanDetailSetup::find($request->id);

        $productionPlan->delivery_location_id =  $request->delivery_location;
        $productionPlan->machine_id =  $request->machine_id;
        $productionPlan->no_of_heads =  $request->no_of_heads;
        $productionPlan->target_production =  $request->target_production;
        $productionPlan->production_date =  $request->production_date;
        $productionPlan->updated_by =  Auth::id();
        $productionPlan->remarks = $request->remarks;

        if($productionPlan->save()){
            $productPlanSetupMaster = ProductionPlanMasterSetup::where('production_date', $productionPlan->production_date)
                ->where('status','!=', 'D')
                ->first();

            if($productPlanSetupMaster == null){
                $productPlanSetupMasterSetup = new ProductionPlanMasterSetup();
                $productPlanSetupMasterSetup->production_date = $productionPlan->production_date;
                $productPlanSetupMasterSetup->total_machine = 0;
                $productPlanSetupMasterSetup->total_running_machine = 0;
                $productPlanSetupMasterSetup->total_idle_machine = 0;
                $productPlanSetupMasterSetup->inserted_by =  Auth::id();
                $productPlanSetupMasterSetup->save();
                $productionPlan->production_plan_master_id = $productPlanSetupMasterSetup->id;
                $productionPlan->save();
            }
            else{

                $productionPlan->production_plan_master_id = $productPlanSetupMaster->id;
                $productionPlan->updated_by =  Auth::id();
                $productionPlan->save();
            }
            return('success');
        }

        return null;
    }

    public function deletePlan(Request $request)
    {
        $supplier = ProductionPlanDetailSetup::find($request->id);
        $supplier->status = 'D';
        $supplier->updated_by = Auth::id();
        if($supplier->save()){
            return true;
        }
        return 'Error';

    }

    public function achivementHome(){
        return view('production.daily.achievement-start');
    }

    public function getAchivement(Request $request){
        $this->validate($request, [
            'production_date' => 'required|date'
        ]);

        return redirect()->route('production.plan.daily.achievement.list', ['date'=>$request->production_date]);
    }

    public function achivementDate($date){

        if($date == null){
            return redirect()->route('production.plan.daily.achievement');
        }
        else{

            if(Auth::user()->hasTaskPermission('lpdoneproduction', Auth::user()->id)){
                if(Auth::user()->hasTaskPermission('lpdtwoproduction', Auth::user()->id)){

                    //$trimsTypes = TrimsType::orderBy('name')->where('status','!=', 'D')->get();
                    $activeProductionPlans = ProductionPlanDetailSetup::activeProductionPlanList(-1, $date);
                    $sectionSetups = SectionSetup::orderBy('name')->where('status','!=', 'D')->get();
                    $machines = MachineSetup::orderBy('name')->where('status', 'A')->get();
                    $stores = Store::orderBy('name')->where('status', 'A')->get();
                    return view('production.daily.achievement', compact('activeProductionPlans',
                        'machines', 'stores', /*'trimsTypes',*/ 'date', 'sectionSetups'));
                }
                else{
                    $activeProductionPlans = ProductionPlanDetailSetup::activeProductionPlanList(1, $date);

                    //return $activeProductionPlans;
                    $sectionSetups = SectionSetup::orderBy('name')->where('status','!=', 'D')->get();
                    $machines = MachineSetup::orderBy('name')->where('status', 'A')->get();
                    $stores = Store::orderBy('name')->where('status', 'A')->get();
                    //$purchaseOrderDetails = $purchaseOrderDetails->where('purchase_order_masters.lpd', 1);
                    return view('production.daily.achievement', compact('activeProductionPlans',
                        'machines', 'stores', /*'trimsTypes',*/ 'date', 'sectionSetups'));
                }
            }
            else{
                //return  $purchaseOrderDetails;
                if(Auth::user()->hasTaskPermission('lpdtwoproduction', Auth::user()->id)){

                    $activeProductionPlans = ProductionPlanDetailSetup::activeProductionPlanList(2, $date);
                    $sectionSetups = SectionSetup::orderBy('name')->where('status','!=', 'D')->get();
                    $machines = MachineSetup::orderBy('name')->where('status', 'A')->get();
                    $stores = Store::orderBy('name')->where('status', 'A')->get();
                    //return  $purchaseOrderDetails;
                    return view('production.daily.achievement', compact('activeProductionPlans',
                        'machines', 'stores', /*'trimsTypes',*/ 'date', 'sectionSetups'));
                }
                else{
                    $activeProductionPlans = ProductionPlanDetailSetup::activeProductionPlanList(0, $date);
                    $sectionSetups = SectionSetup::orderBy('name')->where('status','!=', 'D')->get();
                    $machines = MachineSetup::orderBy('name')->where('status', 'A')->get();
                    $stores = Store::orderBy('name')->where('status', 'A')->get();
                    return view('production.daily.achievement', compact('activeProductionPlans',
                        'machines', 'stores', /*'trimsTypes',*/ 'date', 'sectionSetups'));
                }
            }
        }
    }

    public function saveAchievement(Request $request){
        $productionPlan = ProductionPlanDetailSetup::find($request->id);

       /* $purchaseOrderDetail = PurchaseOrderDetail::where('purchase_order_master_id', $productionPlan->purchase_order_master_id)
            ->where('item_count', $productionPlan->purchase_order_detail_id)
            ->first();*/



        $total_achievement = $request->achievement_production + $request->left_over_production;

        if($total_achievement > ($productionPlan->target_production)){
            return (2);
        }

        $productionPlan->delivery_location_id =  $request->delivery_location;
        $productionPlan->achievement_production =  $request->achievement_production;
        $productionPlan->left_over_production =  $request->left_over_production;
        $productionPlan->variation_production =  $request->target_production - $request->achievement_production;
        $productionPlan->updated_by =  Auth::id();
        $productionPlan->remarks = $request->remarks;
        $productionPlan->status = 'PC';
        if($productionPlan->save()){


            $productPlanSetupMaster = ProductionPlanMasterSetup::where('production_date', $productionPlan->production_date)
                ->where('status','!=', 'D')
                ->first();

            if($productPlanSetupMaster == null){
                $productPlanSetupMasterSetup = new ProductionPlanMasterSetup();
                $productPlanSetupMasterSetup->production_date = $productionPlan->production_date;
                $productPlanSetupMasterSetup->total_machine = 0;
                $productPlanSetupMasterSetup->total_running_machine = 0;
                $productPlanSetupMasterSetup->total_idle_machine = 0;
                $productPlanSetupMasterSetup->inserted_by =  Auth::id();
                $productPlanSetupMasterSetup->save();
                $productionPlan->production_plan_master_id = $productPlanSetupMasterSetup->id;
                $productionPlan->save();
            }
            else{

                $productionPlan->production_plan_master_id = $productPlanSetupMaster->id;
                $productionPlan->updated_by =  Auth::id();
                $productionPlan->save();
            }
            return(1);
        }

        return null;
    }

}
