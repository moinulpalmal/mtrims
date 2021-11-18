<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Unit extends Model
{
    public static function getActiveUnitListForSelect()
    {
        return DB::table('units')
            ->select('id', 'full_unit')
            ->where('status', '!=', 'D')
            ->orderBy('full_unit')
            ->get();
    }
}
