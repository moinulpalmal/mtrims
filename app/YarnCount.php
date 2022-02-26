<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class YarnCount extends Model
{
    public static function getAllNotDeletedYarnCounts(){
        return DB::table('yarn_counts')
        ->join('yarn_types','yarn_types.id', '=', 'yarn_counts.yarn_type_id')
        ->select('yarn_types.name AS yarn_type','yarn_counts.*')
        ->where('yarn_counts.status', '!=', 'D')
        ->get();
    }

    public static function insertYarnCount($request){
        $supplier = new YarnCount();
        $supplier->name = $request->name;
        $supplier->yarn_type_id = $request->yarn_type;
        $supplier->status = 'A';
        if($supplier->save())
        {
            return '1';
        }
        return '0';
    }

    public static function updateYarnCount($request){
        $supplier = YarnCount::find($request->id);
        if($supplier != null){
            $supplier->name = $request->name;
            $supplier->yarn_type_id = $request->yarn_type;
            if($supplier->save())
            {
                return '2';
            }
            return '0';
        }
        return '0';
    }

    public static function activateYarnCount($request){
        $supplier = YarnCount::find($request->id);
        $supplier->status = 'A';
        if($supplier->save())
        {
            return '2';
        }
        return '0';
    }

    public static function inActivateYarnCount($request){
        $supplier = YarnCount::find($request->id);
        $supplier->status = 'I';
        if($supplier->save())
        {
            return '2';
        }
        return '0';
    }

    public static function deleteYarnCount($request){
        $supplier = YarnCount::find($request->id);
        $supplier->status = 'D';
        if($supplier->save())
        {
            return '2';
        }
        return '0';
    }


}
