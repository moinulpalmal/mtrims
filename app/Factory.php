<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class Factory extends Model
{
    public static function getActiveFactoryListForSelect()
    {
        return DB::table('factories')
            ->select('id', 'name')
            ->orderBy('name')
            ->get();
    }

    public static function getAllNotDeletedFactories(){
        return DB::table('factories')
            ->select('*')
            ->where('status', '!=', 'D')
            ->orderBy('name')
            ->get();
    }

    public static function insertFactory($request){
        $factory = new Factory();
        $factory->name = $request->get('name');
        $factory->short_name = $request->get('short_name');
        $factory->address = $request->get('address');
        $factory->vat_no = $request->get('vat_no');
        $factory->bin_no = $request->get('bin_no');
        $factory->manager_info = $request->get('manager_info');
        $factory->contact_person_info = $request->get('contact_person_info');
        $factory->factory_head_info = $request->get('factory_head_info');
        $factory->factory_messenger_info = $request->get('factory_messenger_info');
        $factory->inserted_by = Auth::id();
        $factory->status = 'A';
        if($request->get('IsCHO') == 'on')
        {
            $factory->is_cho = true;
        }
        else
        {
            $factory->is_cho = false;
        }
        if($factory->save())
        {
            return '1';
        }

        return '0';
    }

    public static function updateFactory($request){
        $factory = Factory::find($request->id);
        if(!empty($factory)){
            $factory->name = $request->get('name');
            $factory->short_name = $request->get('short_name');
            $factory->address = $request->get('address');
            $factory->vat_no = $request->get('vat_no');
            $factory->bin_no = $request->get('bin_no');
            $factory->manager_info = $request->get('manager_info');
            $factory->contact_person_info = $request->get('contact_person_info');
            $factory->factory_head_info = $request->get('factory_head_info');
            $factory->factory_messenger_info = $request->get('factory_messenger_info');
            $factory->inserted_by = Auth::id();
            $factory->status = 'A';
            if($request->get('IsCHO') == 'on')
            {
                $factory->is_cho = true;
            }
            else
            {
                $factory->is_cho = false;
            }

            if($factory->save())
            {
                return '2';
            }
            return '0';
        }
        return '0';
    }

    public static function getFactoryDetail($request){
        $factory = Factory::find($request->id);

        $factoryData = array(
            'name' => $factory->name,
            'short_name' => $factory->short_name,
            'address' => $factory->address,
            'is_cho' => $factory->is_cho,
            'vat_no' => $factory->vat_no,
            'bin_no' => $factory->bin_no,
            'contact_person_info' => $factory->contact_person_info,
            'manager_info' => $factory->manager_info,
            'factory_head_info' => $factory->factory_head_info,
            'factory_store_info' => null,
            'factory_messenger_info' => $factory->factory_messenger_info,
            'status' => $factory->status,
            'id' => $factory->id
        );
        return $factoryData;
    }

    public static function activateFactory($request){
        $supplier = Factory::find($request->id);
        $supplier->status = 'A';
        $supplier->last_updated_by = Auth::id();
        if($supplier->save()){
            return '2';
        }
        return '0';
    }

    public static function inActivateFactory($request){
        $supplier = Factory::find($request->id);
        $supplier->status = 'I';
        $supplier->last_updated_by = Auth::id();
        if($supplier->save()){
            return '2';
        }
        return '0';
    }

    public static function deleteFactory($request){
        $supplier = Factory::find($request->id);
        $supplier->status = 'D';
        $supplier->last_updated_by = Auth::id();
        if($supplier->save()){
            return '2';
        }
        return '0';
    }
}
