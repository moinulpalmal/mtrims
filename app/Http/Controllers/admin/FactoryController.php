<?php

namespace App\Http\Controllers\admin;

use App\CRUD\Update;
use App\Factory;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class FactoryController extends Controller
{
    public function index(){
        $factories = Factory::orderBy('name')->get();

        return view('admin.factory.index', compact('factories'));
    }

    public function saveFactory(Request $req)
    {
        $HiddenFactoryID = $req->get('id');
        $DataUpdate = new Update();
        if(!empty($HiddenFactoryID))
        {
            if($req->get('FactoryName'))
            {
                $DataUpdate->update('factories','id',$HiddenFactoryID,'name',$req->get('FactoryName'));
            }
            if($req->get('ShortName'))
            {
                $DataUpdate->update('factories','id',$HiddenFactoryID,'short_name',$req->get('ShortName'));
            }
            if($req->get('FactoryAddress'))
            {
                $DataUpdate->update('factories','id',$HiddenFactoryID,'address',$req->get('FactoryAddress'));
            }
            if($req->get('vat_no'))
            {
                $DataUpdate->update('factories','id',$HiddenFactoryID,'vat_no',$req->get('vat_no'));
            }
            if($req->get('bin_no'))
            {
                $DataUpdate->update('factories','id',$HiddenFactoryID,'bin_no',$req->get('bin_no'));
            }
            if($req->get('contact_person_info'))
            {
                $DataUpdate->update('factories','id',$HiddenFactoryID,'contact_person_info',$req->get('contact_person_info'));
            }
            if($req->get('manager_info'))
            {
                $DataUpdate->update('factories','id',$HiddenFactoryID,'manager_info',$req->get('manager_info'));
            }
            if($req->get('factory_head_info'))
            {
                $DataUpdate->update('factories','id',$HiddenFactoryID,'factory_head_info',$req->get('factory_head_info'));
            }
            if($req->get('factory_messenger_info'))
            {
                $DataUpdate->update('factories','id',$HiddenFactoryID,'factory_messenger_info',$req->get('factory_messenger_info'));
            }
            if($req->get('IsCHO') == 'on')
            {
                $DataUpdate->update('factories','id',$HiddenFactoryID,'is_cho',true);
            }
            else
            {
                $DataUpdate->update('factories','id',$HiddenFactoryID,'is_cho',false);
            }

            return 'Updated';
        }
        else
        {
            /*$table->string('vat_no')->nullable();
            $table->string('manager_info')->nullable();
            $table->string('contact_person_info')->nullable();
            $table->string('factory_head_info')->nullable();
            $table->string('factory_store_info')->nullable();
            $table->string('bin_no')->nullable();*/

            $factory = new Factory();
            $factory->name = $req->get('name');
            $factory->short_name = $req->get('short_name');
            $factory->address = $req->get('address');
            $factory->vat_no = $req->get('vat_no');
            $factory->bin_no = $req->get('bin_no');
            $factory->manager_info = $req->get('manager_info');
            $factory->contact_person_info = $req->get('contact_person_info');
            $factory->factory_head_info = $req->get('factory_head_info');
            //$factory->factory_store_info = $req->get('factory_store_info');
            $factory->factory_messenger_info = $req->get('factory_messenger_info');
            if($req->get('IsCHO') == 'on')
            {
                $factory->is_cho = true;
            }
            else
            {
                $factory->is_cho = false;
            }
            if($factory->save())
            {
                return 'Saved';
            }
        }

        return 'BR';

    }

    public function updateFactory(Request $req)
    {
        $factory = Factory::find($req->id);

        $factoryData = array(
            'name' => $factory->name,
            'short_name' => $factory->short_name,
            'address' => $factory->address,
            'is_cho' => $factory->is_cho,
            'vat_no' => $factory->vat_no,
            'bin_no' => $factory->bin_no,
            'contact_person_info' => $factory->contact_person_info,
            'manager_info' => $factory->manager_info,
            'factory_head_info' => $factory->factory_head_info,
            'factory_store_info' => null,
            'factory_messenger_info' => $factory->factory_messenger_info,
            'id' => $factory->id
        );
        return $factoryData;
    }
}
