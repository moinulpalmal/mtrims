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
Route::get('admin/yarn-type/not-deleted','admin\YarnTypeController@getAllNotDeletedYarnTyps');
Route::get('admin/yarn-count/not-deleted','admin\YarnCountController@getAllNotDeletedYarnCounts');
Route::get('admin/yarn-setup/not-deleted','admin\YarnController@getAllNotDeletedYarns');
Route::get('admin/bank-setup/not-deleted','admin\BankController@getAllNotDeletedBanks');
Route::get('admin/bank-branch/not-deleted','admin\BankBranchController@getAllNotDeletedBankBranchs');
Route::get('production/section-setup/not-deleted','Production\SectionController@getAllNotDeletedSections');
