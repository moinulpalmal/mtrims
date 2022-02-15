<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Supplier;
use Illuminate\Http\Request;

class SupplierController extends Controller
{
    public function index(){
        // $suppliers = Supplier::orderBy('name')->where('status', '!=', 'D')->get();
        // return view('admin.supplier.index', compact('suppliers'));

        return view('admin.supplier.index');
    }

    public function getAllNotDeletedSuppliers(){
        return Supplier::getAllNotDeletedSuppliers();
    }

    public function saveSupplier(Request $request){

        $id = $request->get('id');
        if(!empty($id))
        {
            return Supplier::updateSupplier($request);
        }
        else
        {
            return Supplier::insertSupplier($request);
        }
    }

    public function updateSupplier(Request $req)
    {
        return Supplier::getSupplierDetail($req);
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

    public function activateSupplier(Request $request)
    {
        return Supplier::activateSupplier($request);
    }

    public function inActivate(Request $request)
    {
        return Supplier::inActivateSupplier($request);
    }

    public function deleteSupplier(Request $request)
    {
        return Supplier::deleteSupplier($request);
    }


}