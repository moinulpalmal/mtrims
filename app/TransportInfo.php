<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class TransportInfo extends Model
{
    public static function getTransportListForSelectList(){
        return DB::table('transport_infos')
            ->select('id', 'transport_licence_no')
            ->where('status', 'A')
            ->get();
    }
}
