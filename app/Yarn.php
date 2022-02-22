<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class Yarn extends Model
{
    public static function getAllNotDeletedYarns(){
        return DB::table('yarns')
            ->select('*')
            ->where('status', '!=', 'D')
            ->orderBy('name')
            ->get();
    }

    public static function insertYarn($request){
        $supplier = new Yarn();
        $supplier->yarn_count_id = $request->yarn_count;
        $supplier->unit_id = 2;
        $supplier->color = $request->color;
        $supplier->remarks = $request->remarks;
        $supplier->status = 'A';
        if($supplier->save())
        {
            return '1';
        }
        return '0';
    }

    public static function updateYarn($request){
        $supplier = Yarn::find($request->id);
        if($supplier != null){
            $supplier->yarn_count_id = $request->yarn_count;
            $supplier->color = $request->color;
            $supplier->remarks = $request->remarks;
            if($supplier->save())
            {
                return '2';
            }
            return '0';
        }
        return '0';
    }

    public static function activateYarn($request){
        $supplier = Yarn::find($request->id);
        $supplier->status = 'A';
        if($supplier->save())
        {
            return '2';
        }
        return '0';
    }

    public static function inActivateYarn($request){
        $yarn = Yarn::find($request->id);
        $yarn->status = 'I';
        if($yarn->save())
        {
            return '2';
        }
        return '0';
    }

    public static function deleteYarn($request){
        $supplier = Yarn::find($request->id);
        $supplier->status = 'D';
        if($supplier->save())
        {
            return '2';
        }
        return '0';
    }



}