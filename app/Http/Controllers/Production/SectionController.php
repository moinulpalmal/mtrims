<?php

namespace App\Http\Controllers\Production;

use App\Http\Controllers\Controller;
use App\SectionSetup;
use Illuminate\Http\Request;

class SectionController extends Controller
{
    public function index(){
        $sections = SectionSetup::orderBy('name')->where('status','!=', 'D')->get();

        return view('production.section.index', compact('sections'));
    }

    public function saveSection(Request $request){
        $id = $request->get('id');
        if(!empty($id))
        {
            $supplier = SectionSetup::find($request->id);
            if($supplier != null){
                $supplier->name = $request->name;
                $supplier->remarks = $request->remarks;

                if($supplier->save())
                {
                    return 'Saved';
                }
            }
            return 'Updated';
        }
        else
        {
            $supplier = new SectionSetup();
            $supplier->name = $request->name;
            $supplier->remarks = $request->remarks;
            if($supplier->save())
            {
                return 'Saved';
            }
        }
        return 'BR';
    }

    public function fullDelete(Request $request)
    {
        $supplier = SectionSetup::find($request->id);
        $supplier->status = 'D';
        if($supplier->save()){
            return true;
        }
        return 'Error';

    }

    public function activate(Request $request)
    {
        $supplier = SectionSetup::find($request->id);
        $supplier->status = 'A';
        if($supplier->save()){
            return true;
        }
        return 'Error';

    }

    public function inActivate(Request $request)
    {
        $supplier = SectionSetup::find($request->id);
        $supplier->status = 'IN';
        if($supplier->save()){
            return true;
        }
        return 'Error';

    }

    public function updateSection(Request $req)
    {
        $buyer = SectionSetup::find($req->id);
        if($buyer != null){
            $buyerData = array(
                'name' => $buyer->name,
                'remarks' => $buyer->remarks,
                'id' => $buyer->id
            );
            return $buyerData;
        }
        return 'Error';
    }
}
