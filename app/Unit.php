<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class Unit extends Model
{
    public static function getActiveUnitListForSelect()
    {
        return DB::table('units')
            ->select('id', 'full_unit')
            ->where('status', '=', 'A')
            ->orderBy('full_unit')
            ->get();
    }

    public static function getAllNotDeletedUnits(){
        return DB::table('units')
            ->select('*')
            ->where('status', '!=', 'D')
            ->orderBy('full_unit')
            ->get();
    }


    public static function insertUnit($request){
        $supplier = new Unit();
        $supplier->full_unit = $request->full_unit;
        $supplier->short_unit = $request->short_unit;
        $supplier->status = 'A';
        $supplier->inserted_by = Auth::id();
        if($supplier->save())
        {
            return '1';
        }
        return '0';

    }

    public static function updateUnit($request){
        $supplier = Unit::find($request->id);
        if($supplier != null){
            $supplier->full_unit = $request->full_unit;
            $supplier->short_unit = $request->short_unit;
            $supplier->last_updated_by = Auth::id();
            if($supplier->save())
            {
                return '2';
            }
            return '0';
        }
        return '0';
    }

    public static function getUnitDetail($request){
        $supplier =  Unit::find($request->id);
        if($supplier == null)
            return null;
        $supplierData = array(
            'id' => $supplier->id,
            'full_unit' => $supplier->full_unit,
            'short_unit' => $supplier->short_unit,
            'status' => $supplier->status
        );
        return $supplierData;
    }

    public static function activateUnit($request){
        $supplier = Unit::find($request->id);
        $supplier->status = 'A';
        $supplier->last_updated_by = Auth::id();
        if($supplier->save()){
            return '2';
        }
        return '0';
    }

    public static function inActivateUnit($request){
        $supplier = Unit::find($request->id);
        $supplier->status = 'I';
        $supplier->last_updated_by = Auth::id();
        if($supplier->save()){
            return '2';
        }
        return '0';
    }

    public static function deleteUnit($request){
        $supplier = Unit::find($request->id);
        $supplier->status = 'D';
        $supplier->last_updated_by = Auth::id();
        if($supplier->save()){
            return '2';
        }
        return '0';
    }


}
