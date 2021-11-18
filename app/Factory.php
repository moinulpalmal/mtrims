<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Factory extends Model
{
    public static function getActiveFactoryListForSelect()
    {
        return DB::table('factories')
            ->select('id', 'name')
            ->orderBy('name')
            ->get();
    }
}
