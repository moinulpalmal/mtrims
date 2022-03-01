<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class BeneficiaryBin extends Model
{
    public static function getAllNotDeletedBeneficiaryBins(){
        return DB::table('beneficiary_bins')
            ->join('banks','banks.id', '=', 'beneficiary_bins.bank_id')
            ->select('banks.name AS bank_name','beneficiary_bins.*')
            ->where('beneficiary_bins.status', '!=', 'D')
            ->get();
    }

    public static function insertBeneficiaryBin($request){
        $supplier = new BeneficiaryBin();
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

    public static function updateBeneficiaryBin($request){
        $supplier = BeneficiaryBin::find($request->id);
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

    public static function getBeneficiaryBinDetail($request){
        $supplier =  BeneficiaryBin::find($request->id);

        if($supplier == null)
            return null;

        $BeneficiaryBinData = array(
            'id' => $supplier->id,
            'bank_name' => $supplier->bank_id,
            'bin_no' => $supplier->bin_no,
            'remarks' => $supplier->remarks,
        );
        return $BeneficiaryBinData;
    }

    public static function activateBeneficiaryBin($request){
        $supplier = BeneficiaryBin::find($request->id);
        $supplier->status = 'A';
        $supplier->last_updated_by = Auth::id();
        if($supplier->save()){
            return '2';
        }
        return '0';
    }
    
    public static function inActivateBeneficiaryBin($request){
        $supplier = BeneficiaryBin::find($request->id);
        $supplier->status = 'I';
        $supplier->last_updated_by = Auth::id();
        if($supplier->save()){
            return '2';
        }
        return '0';

    }

    public static function deleteBeneficiaryBin($request){
        $supplier = BeneficiaryBin::find($request->id);
        $supplier->status = 'D';
        $supplier->last_updated_by = Auth::id();
        if($supplier->save()){
            return '2';
        }
        return '0';
    }
}
