<?php

namespace App\Http\Controllers\admin;

use App\Bank;
use App\BeneficiaryBin;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class BeneficiaryBinController extends Controller
{
    public function index()
    {
        $banks = Bank::orderBy('name')->where('status', '!=', 'D')->get();
        return view('admin.bank.beneficiary', compact('banks'));
    }

    public function getAllNotDeletedBeneficiaryBins()
    {
        return BeneficiaryBin::getAllNotDeletedBeneficiaryBins();
    }

    public function saveBeneficiaryBin(Request $request){
        $id = $request->get('id');
        if(!empty($id))
        {
            return BeneficiaryBin::updateBeneficiaryBin($request);
        }
        else
        {
            return BeneficiaryBin::insertBeneficiaryBin($request);
        }
    }

    public function updateBeneficiaryBin(Request $req)
    {
        return BeneficiaryBin::getBeneficiaryBinDetail($req);
    }

    public function activate(Request $request)
    {
        return BeneficiaryBin::activateBeneficiaryBin($request);
    }

    public function inActivate(Request $request)
    {
        return BeneficiaryBin::inActivateBeneficiaryBin($request);
    }

    public function fullDelete(Request $request)
    {
        return BeneficiaryBin::deleteBeneficiaryBin($request);
    }
}
