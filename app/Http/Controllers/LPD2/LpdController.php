<?php

namespace App\Http\Controllers\LPD2;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class LpdController extends Controller
{
    public function index(){
        return view('lpd2.layout.index');
    }
}
