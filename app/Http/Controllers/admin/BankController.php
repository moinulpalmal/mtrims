<?php

namespace App\Http\Controllers\admin;

use App\Bank;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class BankController extends Controller
{
    public function index()
    {
        return view('admin.bank.index');
    }

    public function getAllNotDeletedBanks()
    {
        return Bank::getAllNotDeletedBanks();
    }

    public function saveBank(Request $request){
        $id = $request->get('id');
        if(!empty($id))
        {
            return Bank::updateBank($request);
        }
        else
        {
            return Bank::insertBank($request);
        }
    }

    public function updateBank(Request $req)
    {
        return Bank::getBankDetail($req);
    }

    public function activate(Request $request)
    {
        return Bank::activateBank($request);
    }

    public function inActivate(Request $request)
    {
        return Bank::inActivateBank($request);
    }

    public function fullDelete(Request $request)
    {
        return Bank::deleteBank($request);
    }


}
