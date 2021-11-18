<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Supplier;
use Illuminate\Http\Request;

class SupplierController extends Controller
{
    public function index(){
        $suppliers = Supplier::orderBy('name')->where('status', '!=', 'D')->get();
        return view('admin.supplier.index', compact('suppliers'));
    }

    public function saveSupplier(Request $request){

        $id = $request->get('id');
        if(!empty($id))
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

                if($supplier->save())
                {
                    return 'Saved';
                }

            }
            return 'Updated';
        }
        else
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
            $supplier->status = 'I';
            if($supplier->save())
            {
                return 'Saved';
            }
        }
        return 'BR';
    }

    public function updateSupplier(Request $req)
    {
        $supplier = Supplier::find($req->id);

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
            'remarks' => $supplier->remarks
        );
        return $supplierData;
    }

    public function fullDelete(Request $request)
    {
        $supplier = Supplier::find($request->id);
        $supplier->status = 'D';
        if($supplier->save()){
            return true;
        }
        return 'Error';

    }

    public function blackList(Request $request)
    {
        $supplier = Supplier::find($request->id);
        $supplier->status = 'B';
        if($supplier->save()){
            return true;
        }
        return 'Error';

    }

    public function activate(Request $request)
    {
        $supplier = Supplier::find($request->id);
        $supplier->status = 'A';
        if($supplier->save()){
            return true;
        }
        return 'Error';

    }

    public function inActivate(Request $request)
    {
        $supplier = Supplier::find($request->id);
        $supplier->status = 'IN';
        if($supplier->save()){
            return true;
        }
        return 'Error';

    }
}
