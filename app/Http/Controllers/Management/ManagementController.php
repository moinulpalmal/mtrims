<?php

namespace App\Http\Controllers\Management;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ManagementController extends Controller
{
    public function index(){
        /*return DB::table('view_approved_delivery_summary')
            ->select('*')
            //->whereBetween('challan_date', array($request->from_date, $request->to_date))
            ->get();*/
        return view('management.layout.index');
    }
}
