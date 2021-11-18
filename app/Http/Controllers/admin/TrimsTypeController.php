<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\SectionSetup;
use App\TrimsType;
use Illuminate\Http\Request;

class TrimsTypeController extends Controller
{
    public function index(){
        $trims = TrimsType::orderBy('name')->where('status', '!=', 'D')->get();
        $sectionSetups = SectionSetup::orderBy('name')->where('status', '!=', 'D')->get();
        return view('admin.trims.index', compact('trims', 'sectionSetups'));
    }

    public function saveTrims(Request $request){

        $id = $request->get('id');
        if(!empty($id))
        {
            $supplier = TrimsType::find($request->id);
            if($supplier != null){
                $supplier->name = $request->name;
                $supplier->description = $request->description;
                $supplier->section_setup_id = $request->section;
                $supplier->remarks = $request->remarks;
                $supplier->short_name = $request->short_name;
                $supplier->gross_calculation_amount = $request->gross_calculation_amount;
                if($request->add_amount_percent != 0 || $request->add_amount_percent != null){
                    $supplier->add_amount_percent = $request->add_amount_percent;
                }
                $supplier->lpd = $request->lpd;
                if($supplier->save())
                {
                    return 'Saved';
                }
            }
            return 'Updated';
        }
        else
        {
            $supplier = new TrimsType();
            $supplier->name = $request->name;
            $supplier->description = $request->description;
            $supplier->section_setup_id = $request->section;
            $supplier->remarks = $request->remarks;
            $supplier->lpd = $request->lpd;
            $supplier->short_name = $request->short_name;
            $supplier->gross_calculation_amount = $request->gross_calculation_amount;
            if($request->add_amount_percent != 0 || $request->add_amount_percent != null){
                $supplier->add_amount_percent = $request->add_amount_percent;
            }
            if($supplier->save())
            {
                return 'Saved';
            }
        }
        return 'BR';
    }

    public function updateTrims(Request $req)
    {
        $supplier =  TrimsType::find($req->id);
        if($supplier == null)
            return null;
        $supplierData = array(
            'id' => $supplier->id,
            'name' => $supplier->name,
            'short_name' => $supplier->short_name,
            'gross_calculation_amount' => $supplier->gross_calculation_amount,
            'add_amount_percent' => $supplier->add_amount_percent,
            'description' => $supplier->description,
            'section' => $supplier->section_setup_id,
            'lpd' => $supplier->lpd,
            'remarks' => $supplier->remarks
        );
        return $supplierData;
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

    public function fullDelete(Request $request)
    {
        $supplier = TrimsType::find($request->id);
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
        $supplier = TrimsType::find($request->id);
        $supplier->status = 'A';
        if($supplier->save()){
            return true;
        }
        return 'Error';
    }

    public function inActivate(Request $request)
    {
        $supplier = TrimsType::find($request->id);
        $supplier->status = 'IN';
        if($supplier->save()){
            return true;
        }
        return 'Error';
    }
}
