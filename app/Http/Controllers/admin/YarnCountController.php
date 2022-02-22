<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\YarnCount;
use App\YarnType;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class YarnCountController extends Controller
{
    public function index(){
        $types = YarnType::orderBy('name')->where('status', '=', 'A')->get();
        return view('admin.yarn.count', compact('types'));
    }

    public function getAllNotDeletedYarnCounts()
    {
        return YarnCount::getAllNotDeletedYarnCounts();
    }

    public function saveCount(Request $request){

        $id = $request->get('id');
        if(!empty($id))
        {
            return YarnCount::updateYarnCount($request);
        }
        else
        {
            return YarnCount::insertYarnCount($request);
        }
    }

    public function updateCount(Request $req)
    {
        $supplier =  YarnCount::find($req->id);

        if($supplier == null)
            return null;

        $supplierData = array(
            'id' => $supplier->id,
            'yarn_type_id' => $supplier->yarn_type_id,
            'name' => $supplier->name

        );
        return $supplierData;
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
        return YarnCount::activateYarnCount($request);
    }

    public function inActivate(Request $request)
    {
        return YarnCount::inActivateYarnCount($request);
    }

    public function fullDelete(Request $request)
    {
        return YarnCount::deleteYarnCount($request);
    }

    public function dropDownList(Request $req)
    {
        //$status = 'A';
        $status = 'A';
        $DropDownData = DB::table("yarn_counts")->where("yarn_type_id",$req->YarnTypeID)->where("status", $status)->pluck("name","id");
        return json_encode($DropDownData);
    }



}
