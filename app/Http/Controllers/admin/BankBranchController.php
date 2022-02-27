<?php

namespace App\Http\Controllers\admin;

use App\Bank;
use App\BankBranch;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class BankBranchController extends Controller
{
    public function index()
    {
        $banks = Bank::orderBy('name')->where('status', '!=', 'D')->get();
        return view('admin.bank.branch',compact('banks'));
    }

    public function getAllNotDeletedBankBranchs()
    {
        return BankBranch::getAllNotDeletedBankBranchs();
    }

    public function saveBankBranch(Request $request){
        $id = $request->get('id');
        if(!empty($id))
        {
            return BankBranch::updateBankBranch($request);
        }
        else
        {
            return BankBranch::insertBankBranch($request);
        }
    }

    public function updateBankBranch(Request $req)
    {
        return BankBranch::getBankBranchDetail($req);
    }

    public function activate(Request $request)
    {
        return BankBranch::activateBankBranch($request);
    }

    public function inActivate(Request $request)
    {
        return BankBranch::inActivateBankBranch($request);
    }

    public function fullDelete(Request $request)
    {
        return BankBranch::deleteBankBranch($request);
    }



}
