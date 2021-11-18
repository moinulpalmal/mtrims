<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class TrimsType extends Model
{
    public static function GetAllActiveTrimsTypesForSelectField(){
        return DB::table('trims_types')
            ->select('id', 'name')
            ->where('status','!=', 'D')
            ->orderBy('name', 'ASC')
            ->get();
    }

    public static function GetLpdActiveTrimsTypesForSelectField($lpd){
        return DB::table('trims_types')
            ->select('id', 'name')
            ->where('status','!=', 'D')
            ->where('lpd',$lpd)
            ->orderBy('name', 'ASC')
            ->get();
    }

    public static function GetTrimsTypeName($id){
        return DB::table('trims_types')
            ->select('id', 'name')
            ->where('id', $id)
            ->first();
    }
}
