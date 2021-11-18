<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Unit;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class UnitController extends Controller
{
    public function index(){
        $units = Unit::orderBy('full_unit')->where('status', '!=', 'D')->get();
        return view('admin.unit.index', compact('units'));
    }

    public function saveUnit(Request $request){

        $id = $request->get('id');
        if(!empty($id))
        {
            $supplier = Unit::find($request->id);
            if($supplier != null){
                $supplier->full_unit = $request->full_unit;
                $supplier->short_unit = $request->short_unit;
                if($supplier->save())
                {
                    return 'Saved';
                }

            }
            return 'Updated';
        }
        else
        {
            $supplier = new Unit();
            $supplier->full_unit = $request->full_unit;
            $supplier->short_unit = $request->short_unit;
            if($supplier->save())
            {
                return 'Saved';
            }
        }
        return 'BR';
    }

    public function updateUnit(Request $req)
    {
        $supplier =  Unit::find($req->id);

        if($supplier == null)
            return null;

        $supplierData = array(
            'id' => $supplier->id,
            'full_unit' => $supplier->full_unit,
            'short_unit' => $supplier->short_unit

        );
        return $supplierData;
    }

    public function fullDelete(Request $request)
    {
        $supplier = Unit::find($request->id);
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
        $supplier = Unit::find($request->id);
        $supplier->status = 'A';
        if($supplier->save()){
            return true;
        }
        return 'Error';

    }

    public function inActivate(Request $request)
    {
        $supplier = Unit::find($request->id);
        $supplier->status = 'IN';
        if($supplier->save()){
            return true;
        }
        return 'Error';

    }


}
