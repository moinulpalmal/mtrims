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
Route::get('admin/department/not-deleted','admin\FactoryController@getAllNotDeletedDepartments');


