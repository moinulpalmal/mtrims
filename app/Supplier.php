<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class Supplier extends Model
{
    public static function getAllNotDeletedSuppliers(){
        return DB::table('suppliers')
            ->select('*')
            ->where('status', '!=', 'D')
            ->orderBy('name')
            ->get();
    }

    public static function insertSupplier($request)
    {
        $supplier = new Supplier();
        $supplier->name = $request->name;
        $supplier->address = $request->address;
        $supplier->type = $request->supplier_type;
        $supplier->grade_details = $request->supplier_grade;
        $supplier->owner_name = $request->owner_name;
        $supplier->owner_designation = $request->owner_designation;
        $supplier->owner_email = $request->owner_email;
        $supplier->owner_mobile_no = $request->owner_mobile_no;
        $supplier->primary_contact_person = $request->primary_contact_person;
        $supplier->primary_designation = $request->primary_designation;
        $supplier->primary_mobile_no = $request->primary_mobile_no;
        $supplier->primary_email = $request->primary_email;
        $supplier->secondary_contact_person = $request->secondary_contact_person;
        $supplier->secondary_designation = $request->secondary_designation;
        $supplier->secondary_mobile_no = $request->secondary_mobile_no;
        $supplier->secondary_email = $request->secondary_email;
        $supplier->remarks = $request->remarks;
        $supplier->inserted_by = Auth::id();
        $supplier->status = 'A';
        if($supplier->save())
        {
            return '1';
        }
        return '0';
    }

    public static function updateSupplier($request)
    {
        $supplier = Supplier::find($request->id);
            if($supplier != null){
            $supplier->name = $request->name;
            $supplier->address = $request->address;
            $supplier->type = $request->supplier_type;
            $supplier->grade_details = $request->supplier_grade;
            $supplier->owner_name = $request->owner_name;
            $supplier->owner_designation = $request->owner_designation;
            $supplier->owner_email = $request->owner_email;
            $supplier->owner_mobile_no = $request->owner_mobile_no;
            $supplier->primary_contact_person = $request->primary_contact_person;
            $supplier->primary_designation = $request->primary_designation;
            $supplier->primary_mobile_no = $request->primary_mobile_no;
            $supplier->primary_email = $request->primary_email;
            $supplier->secondary_contact_person = $request->secondary_contact_person;
            $supplier->secondary_designation = $request->secondary_designation;
            $supplier->secondary_mobile_no = $request->secondary_mobile_no;
            $supplier->secondary_email = $request->secondary_email;
            $supplier->remarks = $request->remarks;
            $supplier->remarks = $request->remarks;
            $supplier->last_updated_by = Auth::id();

            if($supplier->save())
            {
                return '2';
            }
            return '0';
        }
        return '0';
    }

    public static function getSupplierDetail($request)
    {
        $supplier = Supplier::find($request->id);
        if($supplier == null)
            return null;
        $supplierData = array(
            'id' => $supplier->id,
            'name' => $supplier->name,
            'address' => $supplier->address,
            'supplier_type' => $supplier->type,
            'supplier_grade' => $supplier->grade_details,
            'owner_name' => $supplier->owner_name,
            'owner_email' => $supplier->owner_email,
            'owner_designation' => $supplier->owner_designation,
            'owner_mobile_no' => $supplier->owner_mobile_no,
            'primary_contact_person' => $supplier->primary_contact_person,
            'primary_mobile_no' => $supplier->primary_mobile_no,
            'primary_email' => $supplier->primary_email,
            'primary_designation' => $supplier->primary_designation,
            'secondary_contact_person' => $supplier->secondary_contact_person,
            'secondary_mobile_no' => $supplier->secondary_mobile_no,
            'secondary_email' => $supplier->secondary_email,
            'secondary_designation' => $supplier->secondary_designation,
            'remarks' => $supplier->remarks,
            'status' => $supplier->status,
        );
        return $supplierData;
    }

    public static function inActivateSupplier($request)
    {
        $supplier = Supplier::find($request->id);
        $supplier->status = 'I';
        $supplier->last_updated_by = Auth::id();
        if($supplier->save()){
            return '2';
        }
        return '0';
    }

    public static function activateSupplier($request)
    {
        $supplier = Supplier::find($request->id);
        $supplier->status = 'A';
        $supplier->last_updated_by = Auth::id();
        if($supplier->save()){
            return '2';
        }
        return '0';
    }

    public static function deleteSupplier($request)
    {
        $supplier = Supplier::find($request->id);
        $supplier->status = 'D';
        $supplier->last_updated_by = Auth::id();
        if($supplier->save()){
            return '2';
        }
        return '0';
    }



}