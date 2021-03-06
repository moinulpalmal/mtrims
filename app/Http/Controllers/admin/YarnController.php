<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Yarn;
use App\YarnType;
use App\YarnCount;
use Illuminate\Http\Request;

class YarnController extends Controller
{
    public function index(){
        $types = YarnType::orderBy('name')->where('status', '!=', 'D')->get();
        $yarns = Yarn::orderBy('color')->where('status', '!=', 'D')->get();
        $counts = YarnCount::orderBy('name')->where('status', '!=', 'D')->get();
        return view('admin.yarn.index', compact('types', 'yarns', 'counts'));
    }

    public function getAllNotDeletedYarns()
    {
        return Yarn::getAllNotDeletedYarns();
    }

    public function saveYarn(Request $request){

        $id = $request->get('id');
        if(!empty($id))
        {
            return Yarn::updateYarn($request);
        }
        else
        {
            return Yarn::insertYarn($request);
        }
    }

    public function updateYarn(Request $req)
    {
        return Yarn::getBankDetail($req);
    }

    public function activate(Request $request)
    {
        return Yarn::activateYarn($request);
    }

    public function inActivate(Request $request)
    {
        return Yarn::inActivateYarn($request);
    }

    public function fullDelete(Request $request)
    {
        return Yarn::deleteYarn($request);
    }


}
