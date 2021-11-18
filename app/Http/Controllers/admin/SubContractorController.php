<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\SubContractor;
use Illuminate\Http\Request;

class SubContractorController extends Controller
{
    public function index(){
        $subContractors = SubContractor::orderBy('name')->where('status', '!=', 'D')->get();
        return view('admin.sub-contractor.index', compact('subContractors'));
    }

    public function saveSubContractor(Request $request){

        //return $request->all();

        $id = $request->get('id');
        if(!empty($id))
        {
            $subContractor = SubContractor::find($request->id);
            if($subContractor != null){
                $subContractor->name = $request->name;
                $subContractor->address = $request->address;
                $subContractor->type = $request->sub_contractor_type;
                $subContractor->grade_details = $request->sub_contractor_grade;
                $subContractor->owner_name = $request->owner_name;
                $subContractor->owner_designation = $request->owner_designation;
                $subContractor->owner_email = $request->owner_email;
                $subContractor->owner_mobile_no = $request->owner_mobile_no;
                $subContractor->primary_contact_person = $request->primary_contact_person;
                $subContractor->primary_designation = $request->primary_designation;
                $subContractor->primary_mobile_no = $request->primary_mobile_no;
                $subContractor->primary_email = $request->primary_email;
                $subContractor->secondary_contact_person = $request->secondary_contact_person;
                $subContractor->secondary_designation = $request->secondary_designation;
                $subContractor->secondary_mobile_no = $request->secondary_mobile_no;
                $subContractor->secondary_email = $request->secondary_email;
                $subContractor->remarks = $request->remarks;
                if($subContractor->save())
                {
                    return 'Saved';
                }
            }
            return 'Updated';
        }
        else
        {
            $subContractor = new SubContractor();
            $subContractor->name = $request->name;
            $subContractor->address = $request->address;
            $subContractor->type = $request->sub_contractor_type;
            $subContractor->grade_details = $request->sub_contractor_grade;
            $subContractor->owner_name = $request->owner_name;
            $subContractor->owner_designation = $request->owner_designation;
            $subContractor->owner_email = $request->owner_email;
            $subContractor->owner_mobile_no = $request->owner_mobile_no;
            $subContractor->primary_contact_person = $request->primary_contact_person;
            $subContractor->primary_designation = $request->primary_designation;
            $subContractor->primary_mobile_no = $request->primary_mobile_no;
            $subContractor->primary_email = $request->primary_email;
            $subContractor->secondary_contact_person = $request->secondary_contact_person;
            $subContractor->secondary_designation = $request->secondary_designation;
            $subContractor->secondary_mobile_no = $request->secondary_mobile_no;
            $subContractor->secondary_email = $request->secondary_email;
            $subContractor->remarks = $request->remarks;
            $subContractor->status = 'I';
            if($subContractor->save())
            {
                return 'Saved';
            }
        }
        return 'BR';
    }

    public function updateSubContractor(Request $req)
    {
        $subContractor = SubContractor::find($req->id);

        if($subContractor == null)
            return null;

        $subContractorData = array(
            'id' => $subContractor->id,
            'name' => $subContractor->name,
            'address' => $subContractor->address,
            'sub_contractor_type' => $subContractor->type,
            'sub_contractor_grade' => $subContractor->grade_details,
            'owner_name' => $subContractor->owner_name,
            'owner_email' => $subContractor->owner_email,
            'owner_designation' => $subContractor->owner_designation,
            'owner_mobile_no' => $subContractor->owner_mobile_no,
            'primary_contact_person' => $subContractor->primary_contact_person,
            'primary_mobile_no' => $subContractor->primary_mobile_no,
            'primary_email' => $subContractor->primary_email,
            'primary_designation' => $subContractor->primary_designation,
            'secondary_contact_person' => $subContractor->secondary_contact_person,
            'secondary_mobile_no' => $subContractor->secondary_mobile_no,
            'secondary_email' => $subContractor->secondary_email,
            'secondary_designation' => $subContractor->secondary_designation,
            'remarks' => $subContractor->remarks
        );
        return $subContractorData;
    }

    public function fullDelete(Request $request)
    {
        $subContractor = SubContractor::find($request->id);
        $subContractor->status = 'D';
        if($subContractor->save()){
            return true;
        }
        return 'Error';

    }

    public function blackList(Request $request)
    {
        $subContractor = SubContractor::find($request->id);
        $subContractor->status = 'B';
        if($subContractor->save()){
            return true;
        }
        return 'Error';

    }

    public function activate(Request $request)
    {
        $subContractor = SubContractor::find($request->id);
        $subContractor->status = 'A';
        if($subContractor->save()){
            return true;
        }
        return 'Error';

    }

    public function inActivate(Request $request)
    {
        $subContractor = SubContractor::find($request->id);
        $subContractor->status = 'IN';
        if($subContractor->save()){
            return true;
        }
        return 'Error';

    }
}
