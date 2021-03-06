<?php

use App\MachineSetup;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});
Route::get('production/machine/not-deleted','Production\MachineController@getAllNotDeletedMachines');
Route::get('admin/factory/not-deleted','admin\FactoryController@getAllNotDeletedFactories');
Route::get('admin/department/not-deleted','admin\DepartmentController@getAllNotDeletedDepartments');
Route::get('admin/store/not-deleted','admin\StoreController@getAllNotDeletedStores');
Route::get('admin/buyer/not-deleted','admin\BuyerController@getAllNotDeletedBuyers');
Route::get('admin/supplier/not-deleted','admin\SupplierController@getAllNotDeletedSuppliers');
Route::get('admin/sub-contractor/not-deleted','admin\SubContractorController@getAllNotDeleteSubcontractors');
Route::get('admin/unit/not-deleted','admin\UnitController@getAllNotDeletedUnits');
Route::get('admin/trims-type/not-deleted','admin\TrimsTypeController@getAllNotDeletedTrimsTyps');
Route::get('admin/product-brand/not-deleted','admin\ProductBrandController@getAllNotDeletedProductBrands');
Route::get('admin/product-category/not-deleted','admin\ProductCategoryController@getAllNotDeletedProductCategory');
Route::get('admin/product-setup/not-deleted','admin\ProductSetupController@getAllNotDeletedProduct');
Route::get('admin/yarn-type/not-deleted','admin\YarnTypeController@getAllNotDeletedYarnTyps');
Route::get('admin/yarn-count/not-deleted','admin\YarnCountController@getAllNotDeletedYarnCounts');
Route::get('admin/yarn-setup/not-deleted','admin\YarnController@getAllNotDeletedYarns');
Route::get('admin/bank-setup/not-deleted','admin\BankController@getAllNotDeletedBanks');
Route::get('admin/bank-branch/not-deleted','admin\BankBranchController@getAllNotDeletedBankBranches');
Route::get('admin/bank-bin/not-deleted','admin\BankBinController@getAllNotDeletedBankBins');
Route::get('admin/bank-beneficiary-bin/not-deleted','admin\BeneficiaryBinController@getAllNotDeletedBeneficiaryBins');
Route::get('admin/bank-hs-code/not-deleted','admin\HSCodeController@getAllNotDeletedHSCodes');
Route::get('production/section-setup/not-deleted','Production\SectionController@getAllNotDeletedSections');
// Route::post('lpd1/purchase-order/detail/product/{id}','LPD1\API\PurchaseOrderController@getPODetailProduct');

Route::get('lpd1/purchase-order/detail/product-list/{id}','LPD1\API\PurchaseOrderController@getPOProductList');
Route::get('lpd1/purchase-order/detail/consumption-plan/{master_id}/{detail_id}','LPD1\API\ConsumptionPlanController@getConsumptionPlanList');
Route::get('lpd1/purchase-order/detail/production-plan/{id}','LPD1\API\PurchaseOrderController@getPOProductionPlanByPOID');
Route::get('lpd1/purchase-order/detail/production-achievement/{id}','LPD1\API\PurchaseOrderController@getPOProductionAchievementByPOID');
Route::get('lpd1/purchase-order/detail/product-current-stock/{id}','LPD1\API\PurchaseOrderController@getPOProductStockByPOID');
Route::get('lpd1/purchase-order/detail/product-approved/{id}','LPD1\API\PurchaseOrderController@getPOProductApprovedByPOID');
Route::get('lpd1/purchase-order/detail/product-not-approved/{id}','LPD1\API\PurchaseOrderController@getPOProductNotApprovedByPOID');
Route::get('lpd1/proforma-invoice/active-po-list','LPD1\API\ProformaInvoiceController@getPOList');


Route::get('lpd2/purchase-order/detail/product-list/{id}','LPD2\API\PurchaseOrderController@getPOProductList');
Route::get('lpd2/purchase-order/detail/production-plan/{id}','LPD2\API\PurchaseOrderController@getPOProductionPlanByPOID');
Route::get('lpd2/purchase-order/detail/consumption-plan/{master_id}/{detail_id}','LPD2\API\ConsumptionPlanController@getConsumptionPlanList');
Route::get('lpd2/purchase-order/detail/production-achievement/{id}','LPD2\API\PurchaseOrderController@getPOProductionAchievementByPOID');
Route::get('lpd2/purchase-order/detail/product-current-stock/{id}','LPD2\API\PurchaseOrderController@getPOProductStockByPOID');
Route::get('lpd2/purchase-order/detail/product-approved/{id}','LPD2\API\PurchaseOrderController@getPOProductApprovedByPOID');
Route::get('lpd2/purchase-order/detail/product-not-approved/{id}','LPD2\API\PurchaseOrderController@getPOProductNotApprovedByPOID');
Route::get('lpd2/proforma-invoice/active-po-list','LPD2\API\ProformaInvoiceController@getPOList');
