<?php

namespace App\Http\Controllers\Production;

use App\Http\Controllers\Controller;
use App\SectionSetup;
use Illuminate\Http\Request;

class SectionController extends Controller
{
    public function index(){
        // $sections = SectionSetup::orderBy('name')->where('status','!=', 'D')->get();

        // return view('production.section.index', compact('sections'));
        return view('production.section.index');
    }

    public function getAllNotDeletedSections()
    {
        return SectionSetup::getAllNotDeletedSections();
    }

    public function saveSection(Request $request){
        $id = $request->get('id');
        if(!empty($id))
        {
            return SectionSetup::updateSectionSetup($request);
        }
        else
        {
            return SectionSetup::insertSectionSetup($request);
        }
    }

    public function activate(Request $request)
    {
        return SectionSetup::activateSectionSetup($request);
    }

    public function inActivate(Request $request)
    {
        return SectionSetup::inActivateSectionSetup($request);
    }

    public function deleteSectionSetup(Request $request){
        return SectionSetup::deleteSectionSetup($request);
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
