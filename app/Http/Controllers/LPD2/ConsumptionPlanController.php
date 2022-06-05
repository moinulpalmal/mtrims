<?php

namespace App\Http\Controllers\LPD2;

use App\ConsumptionPlan;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ConsumptionPlanController extends Controller
{
    public function saveConsumption(Request $request)
    {  
        return ConsumptionPlan::insertConsumptionPlan($request); 
        
    }

    public function updateConsumptionPlan(Request $request)
    {
        return ConsumptionPlan::getConsumptionPlanDetail($request);
    }

    public function deleteConsumption(Request $request){
        return ConsumptionPlan::deleteConsumptionPlan($request);
    }
    
}
