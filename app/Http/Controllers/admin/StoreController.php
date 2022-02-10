<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Store;
use Illuminate\Http\Request;

class StoreController extends Controller
{
    public function index(){
        return view('admin.store.index');
    }

    public function getAllNotDeletedStores(){
        return Store::getNotDeletedStores();
    }

    public function saveStore(Request $req){
        $id = $req->get('id');
        if(!empty($id))
        {
            return Store::updateStore($req);
        }
        else
        {
            return Store::insertStore($req);
        }
    }

    public function updateStore(Request $req)
    {
        return Store::getStoreDetail($req);
    }


    public function activateStore(Request $request)
    {
        return Store::activateStore($request);
    }

    public function deActivateStore(Request $request)
    {
        return Store::inActivateStore($request);
    }

    public function blackList(Request $request)
    {
        return Store::blackListStore($request);
    }

    public function deleteStore(Request $request)
    {
        return Store::deleteStore($request);
    }




}
