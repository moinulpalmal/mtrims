<?php

namespace App\Http\Controllers\LPD2\API;

use App\Http\Controllers\Controller;
use App\PurchaseOrderDetail;
use App\ProductionPlanDetailSetup;
use App\TrimsStock;
use App\DeliveryDetail;
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

    public function getPOProductStockByPOID($id)
    {
        return TrimsStock::getPOProductStockByPOID($id);
    }

    public function getPOProductApprovedByPOID($id)
    {
        return DeliveryDetail::getPOProductApprovedByPOID($id);
    } 

    public function getPOProductNotApprovedByPOID($id)
    {
        return DeliveryDetail::getPOProductNotApprovedByPOID($id);
    }
    
    
}
