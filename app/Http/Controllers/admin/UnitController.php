<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Unit;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class UnitController extends Controller
{
    public function index()
    {
        return view('admin.unit.index');
    }

    public function getAllNotDeletedUnits()
    {
        return Unit::getAllNotDeletedUnits();
    }

    public function saveUnit(Request $request){

        $id = $request->get('id');
        if(!empty($id))
        {
            return Unit::updateUnit($request);
        }
        else
        {
            return Unit::insertUnit($request);
        }
    }

    public function updateUnit(Request $req)
    {
        return Unit::getUnitDetail($req);
    }

    /* public function blackList(Request $request)
     {
         $supplier = Supplier::find($request->id);
         $supplier->status = 'B';
         if($supplier->save()){
             return true;
         }
         return 'Error';

     }*/

    public function activate(Request $request)
    {
        return Unit::activateUnit($request);
    }

    public function inActivate(Request $request)
    {
        return Unit::inActivateUnit($request);
    }

    public function deleteUnit(Request $request){
        return Unit::deleteUnit($request);
    }




}
