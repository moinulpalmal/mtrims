<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class Store extends Model
{
   public static function getActiveStoreListForSelectField(){
       return DB::table('stores')
           ->select('id', 'name')
           ->where('status', '!=', 'D')
           ->orderBy('name')
           ->get();
   }

    public static function getNotDeletedStores(){
        return DB::table('stores')
            ->select('*')
            ->where('status', '!=', 'D')
            ->orderBy('name')
            ->get();
    }

    public static function insertStore($request)
    {
        $supplier = new Store();
        $supplier->name = $request->name;
        $supplier->short_name = $request->short_name;
        $supplier->address = $request->address;
        $supplier->store_type = $request->store_type;
        $supplier->manager_info = $request->manager_info;
        $supplier->contact_person_info = $request->contact_person_info;
        $supplier->inserted_by = Auth::id();
        if($supplier->save())
        {
            return '1';
        }

        return '0';

    }

    public static function updateStore($request)
    {
        $supplier = Store::find($request->id);
        if($supplier != null){
            $supplier->name = $request->name;
            $supplier->short_name = $request->short_name;
            $supplier->address = $request->address;
            $supplier->store_type = $request->store_type;
            $supplier->manager_info = $request->manager_info;
            $supplier->contact_person_info = $request->contact_person_info;
            $supplier->last_updated_by = Auth::id();
            $supplier->status = 'A';
            if($supplier->save())
            {
                return '2';
            }
            return '0';
        }
        return '0';
    }

    public static function getStoreDetail($request)
    {
        $supplier = Store::find($request->id);

        if($supplier == null)
            return null;
        $supplierData = array(
            'id' => $supplier->id,
            'name' => $supplier->name,
            'address' => $supplier->address,
            'short_name' => $supplier->short_name,
            'store_type' => $supplier->store_type,
            'manager_info' => $supplier->manager_info,
            'status' => $supplier->status,
            'contact_person_info' => $supplier->contact_person_info
        );
        return $supplierData;
    }

    public static function activateStore($request){
        $supplier = Store::find($request->id);
        $supplier->status = 'A';
        $supplier->last_updated_by = Auth::id();
        if($supplier->save()){
            return '2';
        }
        return '0';
    }

    public static function inActivateStore($request){
        $supplier = Store::find($request->id);
        $supplier->status = 'I';
        $supplier->last_updated_by = Auth::id();
        if($supplier->save()){
            return '2';
        }
        return '0';
    }

    public static function blackListStore($request){
        $supplier = Store::find($request->id);
        $supplier->status = 'B';
        $supplier->last_updated_by = Auth::id();
        if($supplier->save()){
            return '2';
        }
        return '0';
    }


    public static function deleteStore($request)
    {
        $supplier = Store::find($request->id);
        $supplier->last_updated_by = Auth::id();
        $supplier->status = 'D';
        if($supplier->save()){
            return '2';
        }
        return '0';

    }

}
