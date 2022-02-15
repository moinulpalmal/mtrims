<?php

namespace App\Http\Controllers\admin;

use App\SubContractor;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class SubContractorController extends Controller
{
    public function index()
    {
        return view('admin.sub-contractor.index');
    }

    public function getAllNotDeleteSubcontractors()
    {
        return SubContractor::getAllNotDeleteSubcontractors();
    }

    public function saveSubContractor(Request $request){

        $id = $request->get('id');
        if(!empty($id))
        {
            return SubContractor::updateSubContractor($request);
        }
        else
        {
            return SubContractor::insertSubContractor($request);
        }
    }

    public function updateSubContractor(Request $request)
    {
        return SubContractor::getSubContractorDetail($request);
    }
    
    // public function blackList(Request $request)
    // {
    //     $subContractor = SubContractor::find($request->id);
    //     $subContractor->status = 'B';
    //     if($subContractor->save()){
    //         return true;
    //     }
    //     return 'Error';

    // }
    
    public function activate(Request $request)
    {
        return SubContractor::activateSubContractor($request);   
    }
    
    public function inActivate(Request $request)
    {
        return SubContractor::inActivateSubContractor($request);
    }

    public function deleteSubContractor(Request $request)
    {
        return SubContractor::deleteSubContractor($request);
    }

}
