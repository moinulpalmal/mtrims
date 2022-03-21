<?php

namespace App\Http\Controllers\LPD1\API;

use App\Http\Controllers\Controller;
use App\PurchaseOrderDetail;
use App\ProductionPlanDetailSetup;
use Illuminate\Http\Request;

class PurchaseOrderController extends Controller
{
    public function getPOProductList($id)
    {
        return PurchaseOrderDetail::getPOProductList($id);
    } 

    public function getPOProductionPlanByPOID($id)
    {
        return ProductionPlanDetailSetup::getPOProductionPlanByPOID($id);
    } 

    public function getPOProductionAchievementByPOID($id)
    {
        return ProductionPlanDetailSetup::getPOProductionAchievementByPOID($id);
    } 

}
