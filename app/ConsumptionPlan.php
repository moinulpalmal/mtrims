<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class ConsumptionPlan extends Model
{
    public static function getConsumptionList($purchase_order_master_id,$purchase_order_detail_id) 
    {
        return  DB::table('consumption_plans')
                ->join('purchase_order_masters', 'consumption_plans.purchase_order_master_id', '=', 'purchase_order_masters.id')
                ->join('products', 'consumption_plans.product_id', '=', 'products.id')
                ->join('units', 'consumption_plans.default_unit_id', '=', 'units.id')
                ->select('products.name AS product_name','products.id AS product_id', 'units.full_unit','consumption_plans.planned_qty','consumption_plans.issued_qty',
                'consumption_plans.used_qty','consumption_plans.color','consumption_plans.remarks','consumption_plans.status',
                'consumption_plans.purchase_order_master_id','consumption_plans.purchase_order_detail_id')
                ->where('consumption_plans.status','!=', 'D')
                ->where('consumption_plans.purchase_order_master_id', $purchase_order_master_id)
                ->where('consumption_plans.purchase_order_detail_id', $purchase_order_detail_id)
                ->orderBy('products.name','ASC')
                ->get();
    }


    public static function insertConsumptionPlan($request)
    {
        // $checker = DB::table('consumption_plans')
        //         ->select('product_id')
        //         ->where('purchase_order_master_id',$request->purchase_order_master_id)
        //         ->where('purchase_order_detail_id',$request->item_count)
        //         ->where('product_id',$request->product_name)
        //         ->where('status','!=', 'D')
        //         ->get();

        // if($checker->isEmpty())

        // dd($checker = ConsumptionPlan::productChecker($request));
        $checker = ConsumptionPlan::productChecker($request);
        if($checker == 0)
        {
            $consumptionPlan = new ConsumptionPlan();
            $consumptionPlan->purchase_order_master_id = $request->purchase_order_master_id;
            $consumptionPlan->purchase_order_detail_id = $request->item_count;
            $consumptionPlan->product_id = $request->product_name;
            $consumptionPlan->default_unit_id = $request->unit_name_id;
            $consumptionPlan->planned_qty = $request->planned_qty;
            $consumptionPlan->color = trim($request->con_color);
            $consumptionPlan->remarks = trim($request->con_remarks);
            $consumptionPlan->status = 'A';
            $consumptionPlan->inserted_by = Auth::id();
    
            if($consumptionPlan->save())
            {
                return '1';
            }
            return '0';

        }else{
            
            $consumptionPlan = ConsumptionPlan::where('purchase_order_master_id',$request->purchase_order_master_id)
                    ->where('purchase_order_detail_id',$request->item_count)
                    ->where('product_id',$request->product_name)
                    ->where('status','!=', 'D')
                    ->update([
                        'planned_qty' => $request->get('planned_qty'),
                        'color' =>  trim($request->get('con_color')),
                        'remarks' => trim($request->get('con_remarks')),
                        'last_updated_by' => Auth::id()
                    ]);
                    return '2';
        }
        
    }

    public static function getConsumptionPlanDetail($request)
    {
        $consumption_plan = ConsumptionPlan::where('purchase_order_master_id', $request->purchase_order_master_id)
                            ->where('purchase_order_detail_id',$request->purchase_order_detail_id)
                            ->where('product_id',$request->product_name)
                            ->where('status','!=', 'D')
                            ->get();

        if($consumption_plan != null)
        {
            $consumptionPlanData = array(
                'product_name' => $consumption_plan[0]->product_id,
                'unit_name_id' => $consumption_plan[0]->default_unit_id,
                'planned_qty' => $consumption_plan[0]->planned_qty,
                'con_color' => $consumption_plan[0]->color,
                'con_remarks' => $consumption_plan[0]->remarks,
                'purchase_order_master_id' => $consumption_plan[0]->purchase_order_master_id,
                'purchase_order_detail_id' => $consumption_plan[0]->purchase_order_detail_id,
            );
            return $consumptionPlanData;    
        }     

    }

    public static function deleteConsumptionPlan($request){

        $consumptionPlanDelete = ConsumptionPlan::where('purchase_order_master_id', $request->purchase_order_master_id)
                ->where('purchase_order_detail_id',$request->purchase_order_detail_id)
                ->where('product_id',$request->product_name)
                ->update([
                    'status' => 'D',
                    'last_updated_by' => Auth::id(),
                ]);
                return '2';
    }
    
    private static function productChecker($request)
    {
        return DB::table('consumption_plans')
        ->select('product_id')
        ->where('purchase_order_master_id',$request->purchase_order_master_id)
        ->where('purchase_order_detail_id',$request->item_count)
        ->where('product_id',$request->product_name)
        ->where('status','!=', 'D')
        ->count();
        // ->exists();
        // ->get();
    }





}
