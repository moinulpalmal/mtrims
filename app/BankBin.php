<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class BankBin extends Model
{
    public static function insertBankBin($request){
        $supplier = new BankBin();
        $supplier->bank_id = $request->bank_name;
        $supplier->bin_no = $request->bin_no;
        $supplier->remarks = $request->remarks;
        $supplier->status = 'A';
        $supplier->inserted_by = Auth::id();
        if($supplier->save())
        {
            return '1';
        }
        return '0';
    }

    public static function updateBankBin($request){
        $supplier = BankBin::find($request->id);
        if($supplier != null){
            $supplier->bank_id = $request->bank_name;
            $supplier->bin_no = $request->bin_no;
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

    public static function getBankBinDetail($request){
        $supplier =  BankBin::find($request->id);

        if($supplier == null)
            return null;

        $BankBinData = array(
            'id' => $supplier->id,
            'bank_name' => $supplier->bank_id,
            'bin_no' => $supplier->bin_no,
            'remarks' => $supplier->remarks,
        );
        return $BankBinData;
    }

    public static function activateBankBin($request){
        $supplier = BankBin::find($request->id);
        $supplier->status = 'A';
        $supplier->last_updated_by = Auth::id();
        if($supplier->save()){
            return '2';
        }
        return '0';
    }
    
    public static function inActivateBankBin($request){
        $supplier = BankBin::find($request->id);
        $supplier->status = 'I';
        $supplier->last_updated_by = Auth::id();
        if($supplier->save()){
            return '2';
        }
        return '0';

    }

    public static function deleteBankBin($request){
        $supplier = BankBin::find($request->id);
        $supplier->status = 'D';
        $supplier->last_updated_by = Auth::id();
        if($supplier->save()){
            return '2';
        }
        return '0';
    }


}
