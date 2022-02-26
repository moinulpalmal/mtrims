<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\YarnType;
use Illuminate\Http\Request;

class YarnTypeController extends Controller
{
    public function index(){
        // $types = YarnType::orderBy('name')->where('status', '!=', 'D')->get();
        return view('admin.yarn.type');
    }

    public function getAllNotDeletedYarnTyps()
    {
        return YarnType::getAllNotDeletedYarnTyps();
    }

    public function saveType(Request $request){

        $id = $request->get('id');
        if(!empty($id))
        {
            return YarnType::updateYarnType($request);
        }
        else
        {
            return YarnType::insertYarnType($request);
        }
    }

    public function updateType(Request $req)
    {
        $supplier =  YarnType::find($req->id);

        if($supplier == null)
            return null;

        $supplierData = array(
            'id' => $supplier->id,
            'name' => $supplier->name,
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
        return YarnType::activateYarnType($request);
    }

    public function inActivate(Request $request)
    {
        return YarnType::inActivateYarnType($request);
    }

    public function fullDelete(Request $request)
    {
        return YarnType::deleteYarnType($request);
    }


}
