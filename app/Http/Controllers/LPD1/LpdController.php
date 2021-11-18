<?php

namespace App\Http\Controllers\LPD1;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class LpdController extends Controller
{
    public function index(){
        return view('lpd1.layout.index');
    }
}
