<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Store;
use Illuminate\Http\Request;

class StoreController extends Controller
{
    public function index(){
        $stores = Store::orderBy('name')->where('status','!=', 'D')->get();
        return view('admin.store.index', compact('stores'));
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


    public function activate(Request $request)
    {
        return Store::activateStore($request);
    }

    public function inActivate(Request $request)
    {
        return Store::inActivateStore($request);
    }

    public function blackList(Request $request)
    {
        return Store::blackListStore($request);
    }

    public function fullDelete(Request $request)
    {
        return Store::deleteStore($request);
    }




}
