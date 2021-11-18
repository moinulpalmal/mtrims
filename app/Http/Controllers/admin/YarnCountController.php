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
        $types = YarnType::orderBy('name')->where('status', '!=', 'D')->get();
        $counts = YarnCount::orderBy('name')->where('status', '!=', 'D')->get();
        return view('admin.yarn.count', compact('types', 'counts'));
    }

    public function saveCount(Request $request){

        $id = $request->get('id');
        if(!empty($id))
        {
            $supplier = YarnCount::find($request->id);
            if($supplier != null){
                $supplier->name = $request->name;
                $supplier->yarn_type_id = $request->yarn_type;
                if($supplier->save())
                {
                    return 'Saved';
                }

            }
            return 'Updated';
        }
        else
        {
            $supplier = new YarnCount();
            $supplier->name = $request->name;
            $supplier->yarn_type_id = $request->yarn_type;
            $supplier->status = 'A';
            if($supplier->save())
            {
                return 'Saved';
            }
        }
        return 'BR';
    }

    public function updateCount(Request $req)
    {
        $supplier =  YarnCount::find($req->id);

        if($supplier == null)
            return null;

        $supplierData = array(
            'id' => $supplier->id,
            'yarn_type_id' => $supplier->yarn_type,
            'name' => $supplier->name

        );
        return $supplierData;
    }

    public function fullDelete(Request $request)
    {
        $supplier = YarnCount::find($request->id);
        $supplier->status = 'D';
        if($supplier->save()){
            return true;
        }
        return 'Error';

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
        $supplier = YarnCount::find($request->id);
        $supplier->status = 'A';
        if($supplier->save()){
            return true;
        }
        return 'Error';

    }

    public function inActivate(Request $request)
    {
        $supplier = YarnCount::find($request->id);
        $supplier->status = 'IN';
        if($supplier->save()){
            return true;
        }
        return 'Error';

    }

    public function dropDownList(Request $req)
    {
        //$status = 'A';
        $status = 'A';
        $DropDownData = DB::table("yarn_counts")->where("yarn_type_id",$req->YarnTypeID)->where("status", $status)->pluck("name","id");
        return json_encode($DropDownData);
    }
}
