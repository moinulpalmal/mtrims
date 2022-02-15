<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class SubContractor extends Model
{
    public static function getActiveSubContractorListForSelect()
    {
        return DB::table('sub_contractors')
            ->select('id', 'name')
            ->where('status', '=', 'A')
            ->orderBy('name')
            ->get();
    }

    public static function getAllNotDeleteSubcontractors(){
        return DB::table('sub_contractors')
            ->select('*')
            ->where('status', '!=', 'D')
            ->orderBy('name')
            ->get();
    }

    public static function insertSubContractor($request){
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
        $subContractor->status = 'A';
        $subContractor->inserted_by = Auth::id();
        if($subContractor->save())
        {
            return '1';
        }
        return '0';
    }

    public static function updateSubContractor($request){
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
            $subContractor->last_updated_by = Auth::id();
            if($subContractor->save())
            {
                return '2';
            }
            return '0';
        }
        return '0';
    }

    public static function getSubContractorDetail($request){
        $subContractor = SubContractor::find($request->id);
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
            'remarks' => $subContractor->remarks,
            'status' => $subContractor->status,
        );
        return $subContractorData;
    }

    public static function activateSubContractor($request){
        $subContractor = SubContractor::find($request->id);
        $subContractor->status = 'A';
        $subContractor->last_updated_by = Auth::id();
        if($subContractor->save()){
            return '2';
        }
        return '0';
    }

    public static function inActivateSubContractor($request){
        $subContractor = SubContractor::find($request->id);
        $subContractor->status = 'I';
        $subContractor->last_updated_by = Auth::id();
        if($subContractor->save()){
            return '2';
        }
        return '0';
    }

    public static function deleteSubContractor($request){
        $subContractor = SubContractor::find($request->id);
        $subContractor->status = 'D';
        $subContractor->last_updated_by = Auth::id();
        if($subContractor->save()){
            return '2';
        }
        return '0';
    }


}
