<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\SectionSetup;
use App\TrimsType;
use Illuminate\Http\Request;

class TrimsTypeController extends Controller
{
    public function index(){
        
        $sectionSetups = SectionSetup::orderBy('name')->where('status', '!=', 'D')->get();
        return view('admin.trims.index', compact('sectionSetups'));
    }

    public function getAllNotDeletedTrimsTyps()
    {
        return TrimsType::getAllNotDeletedTrimsTyps();
    }

    // public function GetLpdActiveTrimsTypesForSelectField()
    // {
    //     return TrimsType::GetLpdActiveTrimsTypesForSelectField();
    // }


    public function saveTrims(Request $request){

        $id = $request->get('id');
        if(!empty($id))
        {
            return TrimsType::updateTrims($request);
        }
        else
        {
            return TrimsType::insertTrimsType($request);
        }
    }

    public function updateTrims(Request $request)
    {
        return TrimsType::getTrimsTypeDetail($request);
    }

    public function getTrimsCode(Request $req)
    {
        $supplier =  TrimsType::find($req->id);
        if($supplier == null)
            return null;
        $supplierData = array(
            'short_name' => $supplier->short_name,
            'gross_calculation_amount' => $supplier->gross_calculation_amount,
            'add_amount_percent' => $supplier->add_amount_percent,
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

    public function activateTrims(Request $request)
    {
        return TrimsType::activateTrimsType($request);
    }

    public function deActivateTrims(Request $request)
    {
        return TrimsType::inActivateTrimsType($request);
    }

    public function deleteTrimsType(Request $request)
    {
        return TrimsType::deleteTrimsType($request);
    }


}
