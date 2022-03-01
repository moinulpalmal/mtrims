<?php

namespace App\Http\Controllers\admin;

use App\BankBin;
use App\Bank;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class BankBinController extends Controller
{
    public function index()
    {
        $banks = Bank::orderBy('name')->where('status', '!=', 'D')->get();
        return view('admin.bank.bin', compact('banks'));
    }

    public function getAllNotDeletedBankBins()
    {
        return BankBin::getAllNotDeletedBankBins();
    }

    public function saveBankBin(Request $request){
        $id = $request->get('id');
        if(!empty($id))
        {
            return BankBin::updateBankBin($request);
        }
        else
        {
            return BankBin::insertBankBin($request);
        }
    }

    public function updateBankBin(Request $req)
    {
        return BankBin::getBankBinDetail($req);
    }

    public function activate(Request $request)
    {
        return BankBin::activateBankBin($request);
    }

    public function inActivate(Request $request)
    {
        return BankBin::inActivateBankBin($request);
    }

    public function fullDelete(Request $request)
    {
        return BankBin::deleteBankBin($request);
    }


}
