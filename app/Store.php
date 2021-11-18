<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Store extends Model
{
   public static function getActiveStoreListForSelectField(){
       return DB::table('stores')
           ->select('id', 'name')
           ->where('status', '!=', 'D')
           ->orderBy('name')
           ->get();
   }
}
