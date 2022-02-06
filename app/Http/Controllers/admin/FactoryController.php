<?php

namespace App\Http\Controllers\admin;

use App\CRUD\Update;
use App\Factory;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class FactoryController extends Controller
{
    public function index(){
      /*  $factories = Factory::orderBy('name')->get();*/
        return view('admin.factory.index'/*, compact('factories')*/);
    }

    public function getAllNotDeletedFactories(){
       return Factory::getAllNotDeletedFactories();
    }

    public function saveFactory(Request $req)
    {
        $HiddenFactoryID = $req->get('id');
        if(!empty($HiddenFactoryID))
        {
            return Factory::updateFactory($req);
        }
        else
        {
           return Factory::insertFactory($req);
        }

    }

    public function updateFactory(Request $req)
    {
        return Factory::getFactoryDetail($req);
    }

    public function deleteFactory(Request $request){
        return Factory::deleteFactory($request);
    }

    public function activateFactory(Request $request){
        return Factory::activateFactory($request);
    }

    public function deActivateFactory(Request $request){
        return Factory::inActivateFactory($request);
    }
}
