<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Middleware;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Auth::routes();
Route::get('/', function () {
        return view('home');
})->middleware('auth')->name('start');

/*
Route::get('/', function () {
    return view('welcome');
});*/
Route::middleware('auth')->group(function (){
    Route::get('/home', 'HomeController@index')->name('home');
    Route::get('/home/profile', 'ProfileController@index')->name('home.profile');
    Route::get('/home/profile/change-password', 'ProfileController@changePassword')->name('home.profile.change-password');
    Route::post('/home/profile/update-password', 'ProfileController@updatePassword')->name('home.profile.update-password');
});
    Route::group(['as' => 'admin.','prefix' => 'admin','namespace' => 'Admin','middleware' => ['auth','administrator','restoreuser']] , function(){
        Route::get('historical-user','UserController@historicalUser')->name('historical-user');
    });

    Route::group(['as' => 'admin.','prefix' => 'admin','namespace' => 'Admin','middleware' => ['auth','administrator','createuser']] , function(){
        Route::post('user/save','UserController@saveUser')->name('user.save');
        Route::get('user/new','UserController@newUser')->name('user.new');
    });

    Route::group(['as' => 'admin.','prefix' => 'admin','namespace' => 'Admin','middleware' => ['auth','administrator','updateuser']] , function(){
        Route::post('user/update','UserController@updateUser')->name('user.update');
        Route::get('user/edit/{id}','UserController@editUser')->name('user.edit');
    });

    Route::group(['as' => 'admin.','prefix' => 'admin','namespace' => 'Admin','middleware' => ['auth','administrator','resetpassword']] , function(){
        Route::post('user/password/update','UserController@updatePassword')->name('user.password.update');
        Route::get('user/password/reset/{id}','UserController@resetPassword')->name('user.password.reset');
    });


    Route::group(['as' => 'admin.','prefix' => 'admin','namespace' => 'Admin','middleware' => ['auth','administrator']] , function(){
        //dashboard
        Route::get('home','AdminController@index')->name('home');

        Route::get('user','UserController@index')->name('user');
        Route::get('user/detail/{id}','UserController@detail')->name('user.detail');

        Route::delete('user/delete','UserController@softDelete')->name('user.delete');
        Route::delete('user/restore','UserController@restore')->name('user.restore');
        Route::delete('user/remove','UserController@fullDelete')->name('user.remove');
        Route::delete('user/access/block','UserController@blockAccess')->name('user.access.block');
        Route::delete('user/access/provide','UserController@provideAccess')->name('user.access.provide');

        //Route::delete('full-delete-user','UserController@fullDelete')->name('full-delete-user');
        //Route::get('user/detail/{id}','UserController@detail')->name('user.detail');

        Route::delete('block-approval-access','UserController@blockApprovalAccess')->name('block-approval-access');
        Route::delete('user.provide-approval-access','UserController@provideApprovalAccess')->name('provide-approval-access');

        //user role management
            Route::post('user.apply-role', 'UserController@applyRole')->name('user.apply-role');

            //Route::get('user.apply-role/{role_id}/{user_id}', 'UserController@applyRole')->name('user.apply-role');
            //Route::get('user.delete-role/{role_id}/{user_id}', 'UserController@deleteRole')->name('user.delete-role');
        //user role management

        //role group
            Route::get('user/role','RoleController@index')->name('user.role');
            Route::post('user/role/save','RoleController@saveRole')->name('user.role.save');
            Route::post('user/role/edit','RoleController@updateRole')->name('user.role.edit');
        //role group

        //role task group
        Route::get('user/task','TaskController@index')->name('user.task');
        Route::post('user/task/save','TaskController@saveTask')->name('user.task.save');
        Route::post('user/task/edit','TaskController@updateTask')->name('user.task.edit');
        //role task group

        //factory setup
        Route::get('factory','FactoryController@index')->name('factory');
        Route::post('save-factory','FactoryController@savefactory')->name('save-factory');
        Route::post('edit-factory','FactoryController@updatefactory')->name('edit-factory');
        Route::delete('activate-factory','FactoryController@activatefactory')->name('activate-factory');
        Route::delete('de-activate-factory','FactoryController@deActivatefactory')->name('de-activate-factory');
        Route::delete('delete-factory','FactoryController@deletefactory')->name('delete-factory');
        //factory setup

        //department setup
        Route::get('department','DepartmentController@index')->name('department');
        Route::post('save-department','DepartmentController@saveDepartment')->name('save-department');
        Route::post('edit-department','DepartmentController@updateDepartment')->name('edit-department');
        Route::delete('activate-department','DepartmentController@activateDepartment')->name('activate-department');
        Route::delete('de-activate-department','DepartmentController@deActivateDepartment')->name('de-activate-department');
        Route::delete('delete-department','DepartmentController@deleteDepartment')->name('delete-department');
        //department setup

        //buyer setup
        Route::get('buyer','BuyerController@index')->name('buyer');
        Route::post('save-buyer','BuyerController@saveBuyer')->name('save-buyer');
        Route::post('edit-buyer','BuyerController@updateBuyer')->name('edit-buyer');
        Route::delete('delete-buyer','BuyerController@deleteBuyer')->name('delete-buyer');
        Route::delete('activate-buyer','BuyerController@activateBuyer')->name('activate-buyer');
        Route::delete('de-activate-buyer','BuyerController@deActivateBuyer')->name('de-activate-buyer');
        //buyer setup

        //store setup
        Route::get('store','StoreController@index')->name('store');
        Route::post('save-store','StoreController@saveStore')->name('save-store');
        Route::post('edit-store','StoreController@updateStore')->name('edit-store');
        Route::delete('delete-store','StoreController@deleteStore')->name('delete-store');
        Route::delete('activate-store','StoreController@activateStore')->name('activate-store');
        Route::delete('de-activate-store','StoreController@deActivateStore')->name('de-activate-store');
        //store setup

        //supplier setupSub
        Route::get('supplier','SupplierController@index')->name('supplier');
        Route::post('save-supplier','SupplierController@saveSupplier')->name('save-supplier');
        Route::post('edit-supplier','SupplierController@updateSupplier')->name('edit-supplier');
        Route::delete('activate-supplier','SupplierController@activateSupplier')->name('activate-supplier');
        Route::delete('in-activate-supplier','SupplierController@inActivate')->name('in-activate-supplier');
        Route::delete('black-list-supplier','SupplierController@blackList')->name('black-list-supplier');
        Route::delete('delete-supplier','SupplierController@deleteSupplier')->name('delete-supplier');
        //supplier setup

        //sub-contractor setup
        Route::get('sub-contractor','SubContractorController@index')->name('sub-contractor');
        Route::post('save-sub-contractor','SubContractorController@saveSubContractor')->name('save-sub-contractor');
        Route::post('edit-sub-contractor','SubContractorController@updateSubContractor')->name('edit-sub-contractor');
        Route::delete('activate-sub-contractor','SubContractorController@activate')->name('activate-sub-contractor');
        Route::delete('in-activate-sub-contractor','SubContractorController@inActivate')->name('in-activate-sub-contractor');
        Route::delete('black-list-sub-contractor','SubContractorController@blackList')->name('black-list-sub-contractor');
        Route::delete('delete-sub-contractor','SubContractorController@deleteSubContractor')->name('delete-sub-contractor');
        //sub-contractor setup

        //yarn type setup
        Route::get('yarn/type','YarnTypeController@index')->name('yarn.type');
        Route::post('yarn/type/save','YarnTypeController@saveType')->name('yarn.type.save');
        Route::post('yarn/type/edit','YarnTypeController@updateType')->name('yarn.type.edit');
        Route::delete('yarn/type/activate','YarnTypeController@activate')->name('yarn.type.activate');
        Route::delete('yarn/type/de-activate','YarnTypeController@inActivate')->name('yarn.type.de-activate');
        Route::delete('yarn/type/delete','YarnTypeController@fullDelete')->name('yarn.type.delete');
        //yarn type setup

        //yarn count setup
        Route::get('yarn/count','YarnCountController@index')->name('yarn.count');
        Route::post('yarn/count/save','YarnCountController@saveCount')->name('yarn.count.save');
        Route::post('yarn/count/edit','YarnCountController@updateCount')->name('yarn.count.edit');
        Route::delete('yarn/count/activate','YarnCountController@activate')->name('yarn.count.activate');
        Route::delete('yarn/count/de-activate','YarnCountController@inActivate')->name('yarn.count.de-activate');
        Route::delete('yarn/count/delete','YarnCountController@fullDelete')->name('yarn.count.delete');
        Route::post('yarn/count/drop-down-list','YarnCountController@dropDownList')->name('yarn.count.drop-down-list');
        //yarn type setup

        //yarn setup
        Route::get('yarn/setup','YarnController@index')->name('yarn.setup');
        Route::post('yarn/setup/save','YarnController@saveYarn')->name('yarn.setup.save');
        Route::post('yarn/setup/edit','YarnController@updateYarn')->name('yarn.setup.edit');
        Route::delete('yarn/setup/activate','YarnController@activate')->name('yarn.setup.activate');
        Route::delete('yarn/setup/de-activate','YarnController@inActivate')->name('yarn.setup.de-activate');
        Route::delete('yarn/setup/delete','YarnController@fullDelete')->name('yarn.setup.delete');
        //yarn setup

        //unit setup
        Route::get('unit','UnitController@index')->name('unit');
        Route::post('save-unit','UnitController@saveUnit')->name('save-unit');
        Route::post('edit-unit','UnitController@updateUnit')->name('edit-unit');
        Route::delete('activate-unit','UnitController@activate')->name('unit-activate');
        Route::delete('de_activate-unit','UnitController@inActivate')->name('unit.de-activate');
        Route::delete('delete-unit','UnitController@deleteUnit')->name('delete-unit');
        //unit setup

        //trims type setup
        Route::get('trims-type','TrimsTypeController@index')->name('trims-type');
        Route::post('save-trims-type','TrimsTypeController@saveTrims')->name('save-trims-type');
        Route::post('edit-trims-type','TrimsTypeController@updateTrims')->name('edit-trims-type');
        Route::delete('delete-trims-type','TrimsTypeController@deleteTrimsType')->name('delete-trims-type');
        Route::delete('activate-trims-type','TrimsTypeController@activateTrims')->name('activate-trims-type');
        Route::delete('de-activate-trims-type','TrimsTypeController@deActivateTrims')->name('de-activate-trims-type');
        //trims type setup

        //bank setup
        Route::get('bank/setup','BankController@index')->name('bank.setup');
        Route::post('bank/setup/save','BankController@saveBank')->name('bank.setup.save');
        Route::post('bank/setup/edit','BankController@updateBank')->name('bank.setup.edit');
        Route::delete('bank/setup/activate','BankController@activate')->name('bank.setup.activate');
        Route::delete('bank/setup/de-activate','BankController@inActivate')->name('bank.setup.de-activate');
        Route::delete('bank/setup/delete','BankController@fullDelete')->name('bank.setup.delete');
        //bank setup

        //bank branch setup
        Route::get('bank/branch','BankBranchController@index')->name('bank.branch');
        Route::post('bank/branch/save','BankBranchController@saveBankBranch')->name('bank.branch.save');
        Route::post('bank/branch/edit','BankBranchController@updateBankBranch')->name('bank.branch.edit');
        Route::delete('bank/branch/activate','BankBranchController@activate')->name('bank.branch.activate');
        Route::delete('bank/branch/de-activate','BankBranchController@inActivate')->name('bank.branch.de-activate');
        Route::delete('bank/branch/delete','BankBranchController@fullDelete')->name('bank.branch.delete');
        //bank branch setup

        //bank bin setup
        Route::get('bank/bin','BankBinController@index')->name('bank.bin');
        Route::post('bank/bin/save','BankBinController@saveBankBin')->name('bank.bin.save');
        Route::post('bank/bin/edit','BankBinController@updateBankBin')->name('bank.bin.edit');
        Route::delete('bank/bin/activate','BankBinController@activate')->name('bank.bin.activate');
        Route::delete('bank/bin/de-activate','BankBinController@inActivate')->name('bank.bin.de-activate');
        Route::delete('bank/bin/delete','BankBinController@fullDelete')->name('bank.bin.delete');
        //bank bin setup

        //bank beneficiary bin setup
        Route::get('bank/beneficiary-bin','BeneficiaryBinController@index')->name('bank.beneficiary-bin');
        Route::post('bank/beneficiary-bin/save','BeneficiaryBinController@saveBeneficiaryBin')->name('bank.beneficiary-bin.save');
        Route::post('bank/beneficiary-bin/edit','BeneficiaryBinController@updateBeneficiaryBin')->name('bank.beneficiary-bin.edit');
        Route::delete('bank/beneficiary-bin/activate','BeneficiaryBinController@activate')->name('bank.beneficiary-bin.activate');
        Route::delete('bank/beneficiary-bin/de-activate','BeneficiaryBinController@inActivate')->name('bank.beneficiary-bin.de-activate');
        Route::delete('bank/beneficiary-bin/delete','BeneficiaryBinController@fullDelete')->name('bank.beneficiary-bin.delete');
        //bank beneficiary bin setup

        //bank hs code setup
        Route::get('bank/hs-code','HSCodeController@index')->name('bank.hs-code');
        Route::post('bank/hs-code/save','HSCodeController@saveHSCode')->name('bank.hs-code.save');
        Route::post('bank/hs-code/edit','HSCodeController@updateHSCode')->name('bank.hs-code.edit');
        Route::delete('bank/hs-code/activate','HSCodeController@activate')->name('bank.hs-code.activate');
        Route::delete('bank/hs-code/de-activate','HSCodeController@inActivate')->name('bank.hs-code.de-activate');
        Route::delete('bank/hs-code/delete','HSCodeController@fullDelete')->name('bank.hs-code.delete');
        //bank hs code setup

    });

    Route::group(['as' => 'admin.','prefix' => 'admin','namespace' => 'Admin','middleware' => ['auth']] , function(){

        Route::post('trims-type/get-code','TrimsTypeController@getTrimsCode')->name('trims-type.get-code');
    });
    Route::group(['as' => 'lpd2.','prefix' => 'lpd2','namespace' => 'LPD2','middleware' => ['auth','lpd2', 'lpdtwocreatepo']] , function(){
        Route::get('purchase/order/new','PurchaseOrderController@newPurchaseOrder')->name('purchase.order.new');
        Route::post('purchase/order/save','PurchaseOrderController@savePurchaseOrder')->name('purchase.order.save');
    });

    // LPD 2 Proforma Invoices
    Route::group(['as' => 'lpd2.','prefix' => 'lpd2','namespace' => 'LPD2','middleware' => ['auth','lpd2', 'lpdtwopi']] , function(){
        Route::get('proforma-invoice/po-list','ProformaInvoiceController@poList')->name('proforma-invoice.po-list');
        Route::get('proforma-invoice/po/pi-list/{id}','ProformaInvoiceController@poPIList')->name('proforma-invoice.po.pi-list');


        Route::post('proforma-invoice/po/pi-single/save','ProformaInvoiceController@saveNewSinglePI')->name('proforma-invoice.po.pi-single.save');
        Route::post('proforma-invoice/po/pi-single/update','ProformaInvoiceController@updateSinglePI')->name('proforma-invoice.po.pi-single.update');

        Route::delete('proforma-invoice/approve','ProformaInvoiceController@approvePI')->name('proforma-invoice.approve');
        Route::delete('proforma-invoice/reject','ProformaInvoiceController@disApprovePI')->name('proforma-invoice.reject');
        Route::delete('proforma-invoice/delete','ProformaInvoiceController@deletePI')->name('proforma-invoice.delete');

        //Route::post('proforma-invoice/po/pi-follow/new','ProformaInvoiceController@newFollowPI')->name('proforma-invoice.po.pi-follow.new');
        Route::post('proforma-invoice/po/pi-follow/save','ProformaInvoiceController@saveNewFollowPI')->name('proforma-invoice.po.pi-follow.save');
        Route::post('proforma-invoice/po/pi-follow/update','ProformaInvoiceController@updateFollowPI')->name('proforma-invoice.po.pi-follow.update');

        Route::get('proforma-invoice/download/{id}','ProformaInvoiceController@download')->name('proforma-invoice.download');

        Route::get('proforma-invoice/pi-po-lost','ProformaInvoiceController@poList')->name('proforma-invoice.pi-po-lost');
        Route::get('proforma-invoice','ProformaInvoiceController@index')->name('proforma-invoice');
    });

    // LPD 2 Proforma Invoices

// LPD 2 Proforma Invoices
Route::group(['as' => 'lpd1.','prefix' => 'lpd1','namespace' => 'LPD1','middleware' => ['auth','lpd1', 'lpdonepi']] , function(){
    Route::get('proforma-invoice/po-list','ProformaInvoiceController@poList')->name('proforma-invoice.po-list');
    Route::get('proforma-invoice/po/pi-list/{id}','ProformaInvoiceController@poPIList')->name('proforma-invoice.po.pi-list');


    Route::post('proforma-invoice/po/pi-single/save','ProformaInvoiceController@saveNewSinglePI')->name('proforma-invoice.po.pi-single.save');
    Route::post('proforma-invoice/po/pi-single/update','ProformaInvoiceController@updateSinglePI')->name('proforma-invoice.po.pi-single.update');

    Route::delete('proforma-invoice/approve','ProformaInvoiceController@approvePI')->name('proforma-invoice.approve');
    Route::delete('proforma-invoice/reject','ProformaInvoiceController@disApprovePI')->name('proforma-invoice.reject');
    Route::delete('proforma-invoice/delete','ProformaInvoiceController@deletePI')->name('proforma-invoice.delete');

    //Route::post('proforma-invoice/po/pi-follow/new','ProformaInvoiceController@newFollowPI')->name('proforma-invoice.po.pi-follow.new');
    Route::post('proforma-invoice/po/pi-follow/save','ProformaInvoiceController@saveNewFollowPI')->name('proforma-invoice.po.pi-follow.save');
    Route::post('proforma-invoice/po/pi-follow/update','ProformaInvoiceController@updateFollowPI')->name('proforma-invoice.po.pi-follow.update');

    Route::get('proforma-invoice/download/{id}','ProformaInvoiceController@download')->name('proforma-invoice.download');

    Route::get('proforma-invoice/pi-po-lost','ProformaInvoiceController@poList')->name('proforma-invoice.pi-po-lost');
    Route::get('proforma-invoice','ProformaInvoiceController@index')->name('proforma-invoice');
});

// LPD 2 Proforma Invoices


    Route::group(['as' => 'lpd2.','prefix' => 'lpd2','namespace' => 'LPD2','middleware' => ['auth','lpd2']] , function(){
    //dashboard
    Route::get('home','LpdController@index')->name('home');
    //dashboard
    //purchase order master
    Route::get('purchase/order','PurchaseOrderController@index')->name('purchase.order');
    Route::get('purchase/order/active','PurchaseOrderController@index')->name('purchase.order.active');
    Route::delete('purchase/order/delete','PurchaseOrderController@delete')->name('purchase.order.delete');
    //Route::delete('purchase/order/approve','PurchaseOrderController@approve')->name('purchase.order.approve');
    Route::delete('purchase/order/cancel','PurchaseOrderController@cancel')->name('purchase.order.cancel');
    Route::delete('purchase/order/complete','PurchaseOrderController@poComplete')->name('purchase.order.complete');
    Route::delete('purchase/order/restore-complete','PurchaseOrderController@poCompleteRestore')->name('purchase.order.restore-complete');
//    Route::get('purchase/order/edit/{id}','PurchaseOrderController@edit')->name('purchase.order.edit');
    Route::post('purchase/order/update','PurchaseOrderController@updatePurchaseOrder')->name('purchase.order.update');
    Route::post('purchase/order/update-proposal-date','PurchaseOrderController@proposeDate')->name('purchase.order.update-proposal-date');
    Route::post('purchase/order/approve-proposal-date','PurchaseOrderController@approveDate')->name('purchase.order.approve-proposal-date');
    //purchase order master

        //purchase order close
        Route::delete('purchase/order/close/request','PurchaseOrderCloseController@poCompleteRequest')->name('purchase.order.close.request');
        Route::delete('purchase/order/close/approve','PurchaseOrderCloseController@poCompleteApprove')->name('purchase.order.close.approve');
        Route::delete('purchase/order/close/restore','PurchaseOrderCloseController@poCompleteRestore')->name('purchase.order.close.restore');
        Route::get('purchase/order/closed','PurchaseOrderCloseController@closed')->name('purchase.order.closed');
        //purchase order close

    //purchase order detail
    Route::get('purchase/order/detail/{id}','PurchaseOrderController@details')->name('purchase.order.detail');
    Route::post('purchase/order/detail/edit','PurchaseOrderController@editDetail')->name('purchase.order.detail.edit');
    Route::post('purchase/order/detail/save','PurchaseOrderController@saveDetail')->name('purchase.order.detail.save');
    Route::delete('purchase/order/detail/delete','PurchaseOrderController@deleteDetail')->name('purchase.order.detail.delete');
    Route::delete('purchase/order/detail/complete','PurchaseOrderController@completeDetail')->name('purchase.order.detail.complete');

    //reports
    Route::get('purchase/order/detail/plan-report/{id}','PurchaseOrderController@planReport')->name('purchase.order.detail.plan-report');
    Route::get('purchase/order/detail/achievement-report/{id}','PurchaseOrderController@achievementReport')->name('purchase.order.detail.achievement-report');
    Route::get('purchase/order/detail/stock-report/{id}','PurchaseOrderController@currentStockReport')->name('purchase.order.detail.stock-report');
    Route::get('purchase/order/detail/delivery-report/{id}','PurchaseOrderController@deliveryReport')->name('purchase.order.detail.delivery-report');
    Route::get('purchase/order/detail/delivery-not-approved-report/{id}','PurchaseOrderController@deliveryReportNotApproved')->name('purchase.order.detail.delivery-not-approved-report');
    //reports
    //Route::get('purchase/order/revise/{id}','PurchaseOrderController@revise')->name('purchase.order.revise');
    //Route::post('purchase/order/revise-update','PurchaseOrderController@reviseUpdate')->name('purchase.order.revise-update');

    //purchase order detail

    //proforma invoice
    Route::post('proforma/invoice/generate','ProformaInvoiceController@generate')->name('proforma.invoice.generate');
    Route::post('proforma/invoice/update','ProformaInvoiceController@update')->name('proforma.invoice.update');
    Route::delete('proforma/invoice/approve','ProformaInvoiceController@approve')->name('proforma.invoice.approve');
    Route::get('proforma/invoice/download/{id}','ProformaInvoiceController@download')->name('proforma.invoice.download');

    //proforma invoice
});

    Route::group(['as' => 'lpd1.','prefix' => 'lpd1','namespace' => 'LPD1','middleware' => ['auth','lpd1','lpdonecreatepo']] , function(){
        Route::get('purchase/order/new','PurchaseOrderController@newPurchaseOrder')->name('purchase.order.new');
        Route::post('purchase/order/save','PurchaseOrderController@savePurchaseOrder')->name('purchase.order.save');
    });

Route::group(['as' => 'lpd1.','prefix' => 'lpd1','namespace' => 'LPD1','middleware' => ['auth','lpd1']] , function(){
    //dashboard
    Route::get('home','LpdController@index')->name('home');
    //dashboard
    Route::get('purchase/order','PurchaseOrderController@index')->name('purchase.order');
    //purchase order master
    Route::get('purchase/order/active','PurchaseOrderController@index')->name('purchase.order.active');
    Route::delete('purchase/order/delete','PurchaseOrderController@delete')->name('purchase.order.delete');
    //Route::delete('purchase/order/approve','PurchaseOrderController@approve')->name('purchase.order.approve');
    Route::delete('purchase/order/cancel','PurchaseOrderController@cancel')->name('purchase.order.cancel');


    //purchase order close
    Route::delete('purchase/order/close/request','PurchaseOrderCloseController@poCompleteRequest')->name('purchase.order.close.request');
    Route::delete('purchase/order/close/approve','PurchaseOrderCloseController@poCompleteApprove')->name('purchase.order.close.approve');
    Route::delete('purchase/order/close/restore','PurchaseOrderCloseController@poCompleteRestore')->name('purchase.order.close.restore');
    Route::get('purchase/order/closed','PurchaseOrderCloseController@closed')->name('purchase.order.closed');
    //purchase order close

//    Route::get('purchase/order/edit/{id}','PurchaseOrderController@edit')->name('purchase.order.edit');
    Route::post('purchase/order/update','PurchaseOrderController@updatePurchaseOrder')->name('purchase.order.update');
    Route::post('purchase/order/update-proposal-date','PurchaseOrderController@proposeDate')->name('purchase.order.update-proposal-date');
    Route::post('purchase/order/approve-proposal-date','PurchaseOrderController@approveDate')->name('purchase.order.approve-proposal-date');
    //purchase order master

    //purchase order detail
    Route::get('purchase/order/detail/{id}','PurchaseOrderController@details')->name('purchase.order.detail');
    Route::post('purchase/order/detail/get-data','PurchaseOrderController@getPurchaseOrderDetail')->name('purchase.order.detail.get-data');
    Route::post('purchase/order/detail/edit','PurchaseOrderController@editDetail')->name('purchase.order.detail.edit');
    Route::post('purchase/order/detail/save','PurchaseOrderController@saveDetail')->name('purchase.order.detail.save');
    Route::delete('purchase/order/detail/delete','PurchaseOrderController@deleteDetail')->name('purchase.order.detail.delete');
    Route::delete('purchase/order/detail/complete','PurchaseOrderController@completeDetail')->name('purchase.order.detail.complete');
    //reports
    Route::get('purchase/order/detail/plan-report/{id}','PurchaseOrderController@planReport')->name('purchase.order.detail.plan-report');
    Route::get('purchase/order/detail/achievement-report/{id}','PurchaseOrderController@achievementReport')->name('purchase.order.detail.achievement-report');
    Route::get('purchase/order/detail/stock-report/{id}','PurchaseOrderController@currentStockReport')->name('purchase.order.detail.stock-report');
    Route::get('purchase/order/detail/delivery-report/{id}','PurchaseOrderController@deliveryReport')->name('purchase.order.detail.delivery-report');
    Route::get('purchase/order/detail/delivery-not-approved-report/{id}','PurchaseOrderController@deliveryReportNotApproved')->name('purchase.order.detail.delivery-not-approved-report');
    //reports

    //Route::get('purchase/order/revise/{id}','PurchaseOrderController@revise')->name('purchase.order.revise');
    //Route::post('purchase/order/revise-update','PurchaseOrderController@reviseUpdate')->name('purchase.order.revise-update');

    //purchase order detail
    //proforma invoice
    Route::post('proforma/invoice/generate','ProformaInvoiceController@generate')->name('proforma.invoice.generate');
    Route::post('proforma/invoice/update','ProformaInvoiceController@update')->name('proforma.invoice.update');
    Route::delete('proforma/invoice/approve','ProformaInvoiceController@approve')->name('proforma.invoice.approve');
    Route::get('proforma/invoice/download/{id}','ProformaInvoiceController@download')->name('proforma.invoice.download');
    //proforma invoice
});

    Route::group(['as' => 'production.','prefix' => 'production','namespace' => 'Production','middleware' => ['auth']] , function(){

        Route::post('machine/get-list','MachineController@getMachineList')->name('machine.get-list');
    });


    Route::group(['as' => 'production.','prefix' => 'production','namespace' => 'Production','middleware' => ['auth','production', 'sectionsetup']] , function(){
        //section setup
        Route::get('section','SectionController@index')->name('section');
        Route::post('section/save','SectionController@saveSection')->name('section.save');
        Route::post('section/edit','SectionController@updateSection')->name('section.edit');
        Route::delete('section/delete','SectionController@deleteSectionSetup')->name('section.delete');
        Route::delete('section/activate','SectionController@activate')->name('section.activate');
        Route::delete('section/de-activate','SectionController@inActivate')->name('section.de-activate');
        //section setup
    });

    Route::group(['as' => 'production.','prefix' => 'production','namespace' => 'Production','middleware' => ['auth','production', 'machinesetup']] , function(){
        //machine setup
        Route::get('machine','MachineController@index')->name('machine');
        Route::post('machine/save','MachineController@saveMachine')->name('machine.save');
        Route::post('machine/edit','MachineController@updateMachine')->name('machine.edit');
        Route::delete('machine/delete','MachineController@fullDelete')->name('machine.delete');
        Route::delete('machine/activate','MachineController@activate')->name('machine.activate');
        Route::delete('machine/de-activate','MachineController@inActivate')->name('machine.de-activate');
        //machine setup
    });
Route::group(['as' => 'production.','prefix' => 'production','namespace' => 'Production','middleware' => ['auth','production']] , function(){
    //dashboard
    Route::get('home','ProductionController@index')->name('home');
    //dashboard

    //daily production plan
    Route::get('plan/daily/master','ProductionPlanMasterController@index')->name('plan.daily.master');
    Route::post('plan/daily/master/save','ProductionPlanMasterController@savePlan')->name('plan.daily.master.save');
    Route::get('plan/daily/master/achievement/report/{id}','ProductionPlanMasterController@achievementReport')->name('plan.daily.master.achievement.report');
    Route::get('plan/daily/master/plan/report/{id}','ProductionPlanMasterController@planReport')->name('plan.daily.master.plan.report');
    Route::post('plan/daily/master/edit','ProductionPlanMasterController@editPlan')->name('plan.daily.master.edit');
    Route::get('plan/daily/search','ProductionPlanDailyController@index')->name('plan.daily.search');
    Route::get('plan/daily/generate','ProductionPlanDailyController@generatePlan')->name('plan.daily.generate');
    Route::post('plan/daily/save','ProductionPlanDailyController@saveNewPlan')->name('plan.daily.save');
    Route::post('plan/daily/update','ProductionPlanDailyController@updatePlan')->name('plan.daily.update');
    Route::post('plan/daily/achievement/save','ProductionPlanDailyController@saveAchievement')->name('plan.daily.achievement.save');
    Route::get('plan/daily/active','ProductionPlanDailyController@activePlan')->name('plan.daily.active');
    Route::delete('plan/daily/delete','ProductionPlanDailyController@deletePlan')->name('plan.daily.delete');
    Route::get('plan/daily/achievement','ProductionPlanDailyController@achivementHome')->name('plan.daily.achievement');
    Route::post('plan/daily/achievement/get','ProductionPlanDailyController@getAchivement')->name('plan.daily.achievement.get');
    Route::get('plan/daily/achievement/list/{date}','ProductionPlanDailyController@achivementDate')->name('plan.daily.achievement.list');

    //daily production plan

    //production search
    Route::get('search/lpd-po','ProductionSearchController@lpdPOSearch')->name('search.lpd-po');
    Route::get('search/buyer','ProductionSearchController@buyerSearch')->name('search.buyer');
    //production search

    //profit loss report
    Route::get('report/profit','ProfitLossReportController@index')->name('report.profit');
    Route::post('report/profit/generate','ProfitLossReportController@generateReport')->name('report.profit.generate');
    Route::get('report/order-status','ProfitLossReportController@orderStatus')->name('report.order-status');
    Route::post('report/order-status/generate','ProfitLossReportController@orderStatusReport')->name('report.order-status.generate');
    //profit loss report
});

Route::group(['as' => 'store.','prefix' => 'store','namespace' => 'Store','middleware' => ['auth', 'store', 'receivefinishedtrims']] , function(){
    Route::get('receive/trims/finished-in-house','StoreTrimsReceiveController@inHouseReceiveAble')->name('receive.trims.finished-in-house');
    Route::delete('receive/trims/finished-in-house/stored','StoreTrimsReceiveController@receiveInStock')->name('receive.trims.finished-in-house.stored');
    Route::get('receive/trims/received','StoreTrimsReceiveController@index')->name('receive.trims.received');
    Route::delete('receive/trims/reject','StoreTrimsReceiveController@rejectStock')->name('receive.trims.finished-in-house.reject');

    //left over
    Route::get('receive/trims/finished-left-over','StoreTrimsReceiveController@leftOverReceiveAble')->name('receive.trims.finished-left-over');
    Route::get('receive/trims/received-left-over','StoreTrimsReceiveController@leftOverIndex')->name('receive.trims.received-left-over');
    Route::delete('receive/trims/finished-left-over/stored','StoreTrimsReceiveController@receiveInLeftOverStock')->name('receive.trims.finished-left-over.stored');
    //end left over

    //non production replacement
    Route::get('receive/trims/finished-non-production','StoreTrimsReceiveController@nonProductionReceiveAble')->name('receive.trims.finished-non-production');
    Route::get('receive/trims/received-non-production','StoreTrimsReceiveController@nonProductionIndex')->name('receive.trims.received-non-production');
    Route::delete('receive/trims/finished-non-production/stored','StoreTrimsReceiveController@receiveInNonProductionStock')->name('receive.trims.finished-non-production.stored');
    //end non production replacement
});

    Route::group(['as' => 'store.','prefix' => 'store','namespace' => 'Store','middleware' => ['auth', 'store', 'createchallantrims']] , function(){
        Route::get('delivery/trims/po/challan/{id}','DeliveryTrimsController@createChallan')->name('delivery.trims.po.challan');
        Route::post('delivery/trims/po/challan/save','DeliveryTrimsController@saveChallan')->name('delivery.trims.po.challan.save');

    });

    Route::group(['as' => 'store.','prefix' => 'store','namespace' => 'Store','middleware' => ['auth', 'store']] , function(){

        Route::get('home','StoreController@index')->name('home');
        //transport setup
        Route::get('transport','TransportInfoController@index')->name('transport');
        Route::post('save-transport','TransportInfoController@saveTransport')->name('save-transport');
        Route::post('edit-transport','TransportInfoController@updateTransport')->name('edit-transport');
        Route::delete('delete-transport','TransportInfoController@deleteTransport')->name('delete-transport');
        //transport setup

//        Route::delete('receive/trims/finished-in-house/store-approve','StoreTrimsReceiveController@approveInStock')->name('receive.trims.finished-in-house.store.approve');

        Route::get('receive/trims/finished-sub-contact','StoreTrimsReceiveController@inHouseReceiveAble')->name('receive.trims.finished-sub-contact');

        Route::get('stock/trims','StoreTrimsController@index')->name('stock.trims');
        Route::get('stock/left-over-trims','StoreTrimsController@leftOver')->name('stock.left-over-trims');
        Route::get('stock/blockedtrims','StoreTrimsController@blocked')->name('stock.blocked-trims');

        //free stock operations
        Route::get('stock/free-trims/current','StoreTrimsController@free')->name('stock.free-trims.current');
        Route::get('stock/free-trims/requested-left-over','StoreTrimsController@requestedLeftover')->name('stock.free-trims.requested-left-over');
        Route::post('stock/free-trims/request-left-over','StoreTrimsController@requestFreeToLeftOver')->name('stock.free-trims.request-left-over');
        Route::delete('stock/free-trims/reject-left-over','StoreTrimsController@rejectFreeToLeftOver')->name('stock.free-trims.reject-left-over');
        Route::post('stock/free-trims/approve-left-over','StoreTrimsController@approveFreeToLeftOve')->name('stock.free-trims.approve-left-over');

        //end free stock operations

        //delivery trims
         Route::get('delivery/trims','DeliveryTrimsController@index')->name('delivery.trims');
        Route::get('delivery/trims/po-list','DeliveryTrimsController@deliveryPOList')->name('delivery.trims.po-list');

        Route::get('delivery/trims/challan/detail/{id}','DeliveryTrimsController@detailChallan')->name('delivery.trims.challan.detail');
        Route::get('delivery/trims/challan/print-view/{id}','DeliveryTrimsController@challanPrintView')->name('delivery.trims.challan.print-view');

        Route::delete('delivery/trims/challan/delete','DeliveryTrimsController@deleteChallan')->name('delivery.trims.challan.delete');
        Route::delete('delivery/trims/challan/delete-detail','DeliveryTrimsController@deleteDetail')->name('delivery.trims.challan.delete-detail');
        Route::post('delivery/trims/challan/edit-detail','DeliveryTrimsController@editDetail')->name('delivery.trims.challan.edit-detail');
        Route::post('delivery/trims/challan/save-detail','DeliveryTrimsController@saveDetail')->name('delivery.trims.challan.save-detail');
        Route::post('delivery/trims/challan/update-detail','DeliveryTrimsController@updateChallan')->name('delivery.trims.challan.update-detail');

        Route::delete('delivery/trims/challan/approve','DeliveryTrimsController@approveChallan')->name('delivery.trims.challan.approve');
        //delivery trims

        //delivery trims report
        Route::get('report/trims/delivery','TrimsDeliveryReportController@index')->name('report.trims.delivery');
        Route::post('report/trims/delivery/generate','TrimsDeliveryReportController@generateReport')->name('report.trims.delivery.generate');

        //delivery trims report

        //replace request
        Route::post('delivery/trims/replace/generate','DeliveryTrimsController@generateReplaceReq')->name('delivery.trims.replace.generate');
        Route::delete('delivery/trims/replace/delete','DeliveryTrimsController@deleteReplaceReq')->name('delivery.trims.replace.delete');
        Route::delete('delivery/trims/replace/reject','DeliveryTrimsController@rejectReplaceReq')->name('delivery.trims.replace.reject');
        Route::post('delivery/trims/replace/approve','DeliveryTrimsController@approveReplaceReq')->name('delivery.trims.replace.approve');
        Route::delete('delivery/trims/replace/store','DeliveryTrimsController@storeReplaceReq')->name('delivery.trims.replace.store');
        Route::delete('delivery/trims/replace/non-pro-store','DeliveryTrimsController@storeReplaceReq')->name('delivery.trims.replace.non-pro-store');
        //end replace request

    });

    Route::group(['as' => 'merchandising.','prefix' => 'merchandising','namespace' => 'Merchandising','middleware' => ['auth', 'merchandising']] , function(){

        Route::get('home','MerchandisingController@index')->name('home');
        Route::get('purchase/order/search','MerchandisingController@search')->name('purchase.order.search');

        Route::post('purchase/order/search/check','MerchandisingController@checkOrder')->name('purchase.order.search.check');
        Route::post('purchase/order/search/get','MerchandisingController@getOrder')->name('purchase.order.search.get');

        Route::get('purchase/order/detail/{id}','MerchandisingController@orderDetail')->name('purchase.order.detail');
        Route::get('purchase/order/detail/item/{id}/{item}','MerchandisingController@orderItemDetail')->name('purchase.order.detail.item');

        //reports
        Route::get('purchase/order/detail/plan-report/{id}','MerchandisingController@planReport')->name('purchase.order.detail.plan-report');
        Route::get('purchase/order/detail/achievement-report/{id}','MerchandisingController@achievementReport')->name('purchase.order.detail.achievement-report');
        Route::get('purchase/order/detail/stock-report/{id}','MerchandisingController@currentStockReport')->name('purchase.order.detail.stock-report');
        Route::get('purchase/order/detail/delivery-report/{id}','MerchandisingController@deliveryReport')->name('purchase.order.detail.delivery-report');
        Route::get('purchase/order/detail/delivery-not-approved-report/{id}','MerchandisingController@deliveryReportNotApproved')->name('purchase.order.detail.delivery-not-approved-report');
        //reports

        //reports detail
        Route::get('purchase/order/detail/item/plan-report/{id}/{item}','MerchandisingController@planReportItem')->name('purchase.order.detail.item.plan-report');
        Route::get('purchase/order/detail/item/achievement-report/{id}/{item}','MerchandisingController@achievementReportItem')->name('purchase.order.detail.item.achievement-report');
        Route::get('purchase/order/detail/item/stock-report/{id}/{item}','MerchandisingController@currentStockReportItem')->name('purchase.order.detail.item.stock-report');
        Route::get('purchase/order/detail/item/delivery-report/{id}/{item}','MerchandisingController@deliveryReportItem')->name('purchase.order.detail.item.delivery-report');
        Route::get('purchase/order/detail/item/delivery-not-approved-report/{id}/{item}','MerchandisingController@deliveryReportNotApprovedItem')->name('purchase.order.detail.item.delivery-not-approved-report');
        //reports detail
    });

Route::group(['as' => 'management.','prefix' => 'management','namespace' => 'Management','middleware' => ['auth', 'management']] , function(){

    Route::get('home','ManagementController@index')->name('home');

    //sales
    Route::get('sales/report/generate','SalesReportController@report')->name('sales.report.generate');
    Route::post('sales/report/generate-result','SalesReportController@reportGenerate')->name('sales.report.generate-result');

    //delivery
    Route::get('delivery/report/generate','DeliveryReportController@report')->name('delivery.report.generate');
    Route::post('delivery/report/generate-result','DeliveryReportController@reportGenerate')->name('delivery.report.generate-result');

});

