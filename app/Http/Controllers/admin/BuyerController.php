<?php

namespace App\Http\Controllers\admin;

use App\Buyer;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class BuyerController extends Controller
{
    public function index(){       
        return view('admin.buyer.index');
    }

    public function getAllNotDeletedBuyers(){
        return Buyer::getAllNotDeletedBuyers();
    }

    public function saveBuyer(Request $req)
    {
        $HiddenDepartmentID = $req->get('id');
        if(!empty($HiddenDepartmentID))
        {
            return Buyer::updateBuyer($req);
        }
        else
        {
            return Buyer::insertBuyer($req);
        }
    }

    public function updateBuyer(Request $req)
    {
        return Buyer::getBuyerDetail($req);
    }

    public function deActivateBuyer(Request $request)
    {
        return Buyer::inActivateBuyer($request);
    }

    public function activateBuyer(Request $request)
    {
        return Buyer::activateBuyer($request);
    }

    public function deleteBuyer(Request $request)
    {
        return Buyer::deleteBuyer($request);   
    }


}
