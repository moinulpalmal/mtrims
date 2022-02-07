<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Department extends Model
{
    public static function getAllNotDeletedDepartments(){
        return DB::table('departments')
                ->join('factories', 'factories.id', '=', 'departments.factory_id')
                ->select('factories.name AS factory_name', 'departments')
                ->get();
    }
}
