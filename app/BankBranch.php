<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class BankBranch extends Model
{
    public static function getAllNotDeletedBanks(){
        return DB::table('bank_branches')
            ->select('*')
            ->where('status', '!=', 'D')
            ->orderBy('name')
            ->get();
    }

    public static function insertBankBranch($request){
        $supplier = new BankBranch();
        $supplier->bank_id = $request->name;
        $supplier->name = $request->name;
        $supplier->address_one = $request->address_one;
        $supplier->address_two = $request->address_two;
        $supplier->remarks = $request->remarks;
        $supplier->status = 'A';
        $supplier->inserted_by = Auth::id();
        if($supplier->save())
        {
            return '1';
        }
        return '0';
    }

    public static function updateBankBranch($request){
        $supplier = BankBranch::find($request->id);
        if($supplier != null){
            $supplier->name = $request->name;
            $supplier->address_one = $request->address_one;
            $supplier->address_two = $request->address_two;
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

    public static function getBankBranchDetail($request){
        $supplier =  BankBranch::find($request->id);

        if($supplier == null)
            return null;

        $bankbranchData = array(
            'id' => $supplier->id,
            'name' => $supplier->name,
            'address_one' => $supplier->address_one,
            'address_two' => $supplier->address_two,
            'remarks' => $supplier->remarks,
        );
        return $bankbranchData;
    }

    public static function activateBankBranch($request){
        $supplier = BankBranch::find($request->id);
        $supplier->status = 'A';
        $supplier->last_updated_by = Auth::id();
        if($supplier->save()){
            return '2';
        }
        return '0';
    }
    
    public static function inActivateBankBranch($request){
        $supplier = BankBranch::find($request->id);
        $supplier->status = 'I';
        $supplier->last_updated_by = Auth::id();
        if($supplier->save()){
            return '2';
        }
        return '0';

    }

    public static function deleteBankBranch($request){
        $supplier = BankBranch::find($request->id);
        $supplier->status = 'D';
        $supplier->last_updated_by = Auth::id();
        if($supplier->save()){
            return '2';
        }
        return '0';
    }


}
