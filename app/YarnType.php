<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class YarnType extends Model
{
    public static function getAllNotDeletedYarnTyps(){
        return DB::table('yarn_types')
            ->select('*')
            ->where('status', '!=', 'D')
            ->orderBy('name')
            ->get();
    }

    public static function insertYarnType($request){
        $supplier = new YarnType();
        $supplier->name = $request->name;
        $supplier->status = 'A';
        // $supplier->inserted_by = Auth::id();
        if($supplier->save())
        {
            return '1';
        }
        return '0';
    }

    public static function updateYarnType($request){
        $supplier = YarnType::find($request->id);
        if($supplier != null){
            $supplier->name = $request->name;
            // $supplier->last_updated_by = Auth::id();
            if($supplier->save())
            {
                return '2';
            }
            return '0';
        }
        return '0';
    }

    public static function activateYarnType($request){
        $supplier = YarnType::find($request->id);
        $supplier->status = 'A';
        // $supplier->last_updated_by = Auth::id();
        if($supplier->save()){
            return '2';
        }
        return '0';
    }

    public static function inActivateYarnType($request){
        $supplier = YarnType::find($request->id);
        $supplier->status = 'I';
        // $supplier->last_updated_by = Auth::id();
        if($supplier->save())
        {
            return '2';
        }
        return '0';
    }

    public static function deleteYarnType($request){
        $supplier = YarnType::find($request->id);
        $supplier->status = 'D';
        // $supplier->last_updated_by = Auth::id();
        if($supplier->save())
        {
            return '2';
        }
        return '0';
    }


}
