<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Store;
use Illuminate\Http\Request;

class StoreController extends Controller
{
    public function index(){
        $stores = Store::orderBy('name')->where('status','!=', 'D')->get();
        return view('admin.store.index', compact('stores'));
    }

    public function getAllNotDeletedStores(){
        return Store::getNotDeletedStores();
    }

    public function saveStore(Request $request){
        $id = $request->get('id');
        if(!empty($id))
        {
            $supplier = Store::find($request->id);
            if($supplier != null){
                $supplier->name = $request->name;
                $supplier->short_name = $request->short_name;
                $supplier->address = $request->address;
                $supplier->store_type = $request->store_type;
                $supplier->manager_info = $request->manager_info;
                $supplier->contact_person_info = $request->contact_person_info;
                $supplier->status = 'A';
                if($supplier->save())
                {
                    return 'Saved';
                }
            }
            return 'Updated';
        }
        else
        {
            $supplier = new Store();
            $supplier->name = $request->name;
            $supplier->short_name = $request->short_name;
            $supplier->address = $request->address;
            $supplier->store_type = $request->store_type;
            $supplier->manager_info = $request->manager_info;
            $supplier->contact_person_info = $request->contact_person_info;
            if($supplier->save())
            {
                return 'Saved';
            }
        }
        return 'BR';
    }

    public function updateStore(Request $req)
    {
        $supplier = Store::find($req->id);

        if($supplier == null)
            return null;

        $supplierData = array(
            'id' => $supplier->id,
            'name' => $supplier->name,
            'address' => $supplier->address,
            'short_name' => $supplier->short_name,
            'store_type' => $supplier->store_type,
            'manager_info' => $supplier->manager_info,
            'contact_person_info' => $supplier->contact_person_info
        );
        return $supplierData;
    }

    public function fullDelete(Request $request)
    {
        $supplier = Store::find($request->id);
        $supplier->status = 'D';
        if($supplier->save()){
            return true;
        }
        return 'Error';

    }

    public function blackList(Request $request)
    {
        $supplier = Store::find($request->id);
        $supplier->status = 'B';
        if($supplier->save()){
            return true;
        }
        return 'Error';

    }

    public function activate(Request $request)
    {
        $supplier = Store::find($request->id);
        $supplier->status = 'A';
        if($supplier->save()){
            return true;
        }
        return 'Error';

    }

    public function inActivate(Request $request)
    {
        $supplier = Store::find($request->id);
        $supplier->status = 'IN';
        if($supplier->save()){
            return true;
        }
        return 'Error';

    }

}
