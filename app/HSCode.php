<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class HSCode extends Model
{
    public static function getAllNotDeletedHSCodes(){
        return DB::table('h_s_codes')
            ->select('*')
            ->where('status', '!=', 'D')
            ->get();
    }

    public static function insertHSCode($request){
        $supplier = new HSCode();
        $supplier->code = $request->code;
        $supplier->remarks = $request->remarks;
        $supplier->status = 'A';
        $supplier->inserted_by = Auth::id();
        if($supplier->save())
        {
            return '1';
        }
        return '0';
    }

    public static function updateHSCode($request){
        $supplier = HSCode::find($request->id);
        if($supplier != null)
        {
            $supplier->code = $request->code;
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

    public static function getHSCodeDetail($request){
        $supplier =  HSCode::find($request->id);

        if($supplier == null)
            return null;

        $HSCodeData = array(
            'id' => $supplier->id,
            'code' => $supplier->code,
            'remarks' => $supplier->remarks,
        );
        return $HSCodeData;
    }

    public static function activateHSCode($request){
        $supplier = HSCode::find($request->id);
        $supplier->status = 'A';
        $supplier->last_updated_by = Auth::id();
        if($supplier->save())
        {
            return '2';
        }
        return '0';
    }
    
    public static function inActivateHSCode($request){
        $supplier = HSCode::find($request->id);
        $supplier->status = 'I';
        $supplier->last_updated_by = Auth::id();
        if($supplier->save())
        {
            return '2';
        }
        return '0';

    }

    public static function deleteHSCode($request){
        $supplier = HSCode::find($request->id);
        $supplier->status = 'D';
        $supplier->last_updated_by = Auth::id();
        if($supplier->save())
        {
            return '2';
        }
        return '0';
    }
}
