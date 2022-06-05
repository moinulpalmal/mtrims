<?php

namespace App\Http\Controllers\LPD2\API;

use App\ConsumptionPlan;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ConsumptionPlanController extends Controller
{
    public function getConsumptionPlanList($master_id,$detail_id)
    {
        return ConsumptionPlan::getConsumptionList($master_id,$detail_id);
    } 
}
