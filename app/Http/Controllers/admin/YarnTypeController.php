<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\YarnType;
use Illuminate\Http\Request;

class YarnTypeController extends Controller
{
    public function index(){
        $types = YarnType::orderBy('name')->where('status', '!=', 'D')->get();
        return view('admin.yarn.type', compact('types'));
    }

    public function saveType(Request $request){

        $id = $request->get('id');
        if(!empty($id))
        {
            $supplier = YarnType::find($request->id);
            if($supplier != null){
                $supplier->name = $request->name;
                if($supplier->save())
                {
                    return 'Saved';
                }

            }
            return 'Updated';
        }
        else
        {
            $supplier = new YarnType();
            $supplier->name = $request->name;
            $supplier->status = 'A';
            if($supplier->save())
            {
                return 'Saved';
            }
        }
        return 'BR';
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

    public function fullDelete(Request $request)
    {
        $supplier = YarnType::find($request->id);
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
        $supplier = YarnType::find($request->id);
        $supplier->status = 'A';
        if($supplier->save()){
            return true;
        }
        return 'Error';

    }

    public function inActivate(Request $request)
    {
        $supplier = YarnType::find($request->id);
        $supplier->status = 'IN';
        if($supplier->save()){
            return true;
        }
        return 'Error';

    }
}
