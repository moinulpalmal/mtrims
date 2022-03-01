<?php

namespace App\Http\Controllers\admin;

use App\HSCode;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class HSCodeController extends Controller
{
    public function index()
    {
        return view('admin.bank.hscode');
    }

    public function getAllNotDeletedHSCodes()
    {
        return HSCode::getAllNotDeletedHSCodes();
    }

    public function saveHSCode(Request $request){
        $id = $request->get('id');
        if(!empty($id))
        {
            return HSCode::updateHSCode($request);
        }
        else
        {
            return HSCode::insertHSCode($request);
        }
    }

    public function updateHSCode(Request $req)
    {
        return HSCode::getHSCodeDetail($req);
    }

    public function activate(Request $request)
    {
        return HSCode::activateHSCode($request);
    }

    public function inActivate(Request $request)
    {
        return HSCode::inActivateHSCode($request);
    }

    public function fullDelete(Request $request)
    {
        return HSCode::deleteHSCode($request);
    }


}
