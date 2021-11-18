<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Buyer extends Model
{
    public function users()
    {
        return $this->belongsToMany('App\User');
    }

    public static function getActiveBuyerListForSelect()
    {
        return DB::table('buyers')
            ->select('id', 'name')
            ->where('status', '!=', 'D')
            ->orderBy('name')
            ->get();
    }
}
