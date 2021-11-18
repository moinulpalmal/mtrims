<?php

namespace App\Http\Controllers\Store;

use App\Http\Controllers\Controller;
use App\TransportInfo;
use Illuminate\Http\Request;

class TransportInfoController extends Controller
{
    public function index(){
        $buyers = TransportInfo::orderBy('transport_name')->where('status', '!=', 'D')->get();
        return view('store.transport.index', compact('buyers'));
    }

    public function saveTransport(Request $req)
    {
        $HiddenDepartmentID = $req->get('id');
        if(!empty($HiddenDepartmentID))
        {

            $buyer = TransportInfo::find($HiddenDepartmentID);
            if($buyer != null){
                $buyer->transport_name = $req->get('transport_name');
                $buyer->transport_no = $req->get('transport_no');
                $buyer->transport_licence_no = $req->get('transport_licence_no');
                $buyer->driver_name = $req->get('driver_name');
                $buyer->driver_contact_info = $req->get('driver_contact_info');
                if($buyer->save())
                {
                    return 'Updated';
                }
            }
            return 'Error';
        }
        else
        {
            $buyer = new TransportInfo();
            $buyer->transport_name = $req->get('transport_name');
            $buyer->transport_no = $req->get('transport_no');
            $buyer->transport_licence_no = $req->get('transport_licence_no');
            $buyer->driver_name = $req->get('driver_name');
            $buyer->driver_contact_info = $req->get('driver_contact_info');
            if($buyer->save())
            {
                return 'Saved';
            }
        }
        return 'Error';
    }

    public function updateTransport(Request $req)
    {
        $buyer = TransportInfo::find($req->id);
        if($buyer != null){
            $buyerData = array(
                'transport_name' => $buyer->transport_name,
                'transport_no' => $buyer->transport_no,
                'transport_licence_no' => $buyer->transport_licence_no,
                'driver_name' => $buyer->driver_name,
                'driver_contact_info' => $buyer->driver_contact_info,
                'id' => $buyer->id
            );
            return $buyerData;
        }
        return 'Error';
    }


    public function deleteTransport(Request $request){
        $buyer = TransportInfo::find($request->id);
        if($buyer != null){
            $buyer->status = 'D';
            if($buyer->save()){
                return 'success';
            }
            return '0';
        }

        return '0';
    }
}
