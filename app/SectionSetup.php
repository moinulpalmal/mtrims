<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class SectionSetup extends Model
{
   public static function getSectionSetupsForSelect(){
       return DB::table('section_setups')
                ->select('id', 'name')
                ->where('status', '=', 'A')
                ->orderBy('name', 'ASC')
                ->get();
   }
}
