<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class Bank extends Model
{
    public static function getAllNotDeletedBanks(){
        return DB::table('banks')
            ->select('*')
            ->where('status', '!=', 'D')
            ->orderBy('name')
            ->get();
    }

    public static function insertBank($request){
        $supplier = new Bank();
        $supplier->name = $request->name;
        $supplier->short_name = $request->short_name;
        $supplier->swift_code = $request->swift_code;
        $supplier->remarks = $request->remarks;
        $supplier->status = 'A';
        $supplier->inserted_by = Auth::id();
        if($supplier->save())
        {
            return '1';
        }
        return '0';
    }

    public static function updateBank($request){
        $supplier = Bank::find($request->id);
        if($supplier != null){
            $supplier->name = $request->name;
            $supplier->short_name = $request->short_name;
            $supplier->swift_code = $request->swift_code;
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

    public static function getBankDetail($request){
        $supplier =  Bank::find($request->id);

        if($supplier == null)
            return null;

        $bankData = array(
            'id' => $supplier->id,
            'name' => $supplier->name,
            'short_name' => $supplier->short_name,
            'swift_code' => $supplier->swift_code,
            'remarks' => $supplier->remarks,
        );
        return $bankData;
    }

    public static function activateBank($request){
        $supplier = Bank::find($request->id);
        $supplier->status = 'A';
        $supplier->last_updated_by = Auth::id();
        if($supplier->save()){
            return '2';
        }
        return '0';
    }
    
    public static function inActivateBank($request){
        $supplier = Bank::find($request->id);
        $supplier->status = 'I';
        $supplier->last_updated_by = Auth::id();
        if($supplier->save()){
            return '2';
        }
        return '0';

    }

    public static function deleteBank($request){
        $supplier = Bank::find($request->id);
        $supplier->status = 'D';
        $supplier->last_updated_by = Auth::id();
        if($supplier->save()){
            return '2';
        }
        return '0';
    }

}
