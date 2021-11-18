<?php

namespace App\Http\Controllers\Production;

use App\Http\Controllers\Controller;
use App\MachineSetup;
use App\SectionSetup;
use App\TrimsType;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class MachineController extends Controller
{
    public function index(){
        $machines = MachineSetup::orderBy('name')->where('status','!=', 'D')->get();
        //$trimsTypes = TrimsType::orderBy('name')->where('status','!=', 'D')->get();
        $sectionSetups = SectionSetup::orderBy('name')->where('status','!=', 'D')->get();

        return view('production.machine.index', compact('machines', 'sectionSetups'));
    }

    public function saveMachine(Request $request){
        //return $request->all();

        $id = $request->get('id');
        if(!empty($id))
        {
            $supplier = MachineSetup::find($request->id);
            if($supplier != null){
                $supplier->name = $request->name;
                //$supplier->trims_type_id = $request->trims_type;
                $supplier->section_setup_id = $request->section;
                $supplier->remarks = $request->remarks;
                if($request->IsSubCon == "on"){
                    $supplier->is_sub_con = true;
                }
                else{
                    $supplier->is_sub_con = false;
                }


                if($supplier->save())
                {
                    return 'Saved';
                }
            }
            return 'Updated';
        }
        else
        {
            $supplier = new MachineSetup();
            $supplier->name = $request->name;
            //$supplier->trims_type_id = $request->trims_type;
            $supplier->section_setup_id = $request->section;
            $supplier->remarks = $request->remarks;
            if($request->IsSubCon == "on"){
                $supplier->is_sub_con = true;
            }

            if($supplier->save())
            {
                return 'Saved';
            }
        }
        return 'BR';
    }

    public function fullDelete(Request $request)
    {
        $supplier = MachineSetup::find($request->id);
        $supplier->status = 'D';
        if($supplier->save()){
            return true;
        }
        return 'Error';

    }

    public function activate(Request $request)
    {
        $supplier = MachineSetup::find($request->id);
        $supplier->status = 'A';
        if($supplier->save()){
            return true;
        }
        return 'Error';

    }

    public function inActivate(Request $request)
    {
        $supplier = MachineSetup::find($request->id);
        $supplier->status = 'IN';
        if($supplier->save()){
            return true;
        }
        return 'Error';

    }

    public function updateMachine(Request $req)
    {
        $buyer = MachineSetup::find($req->id);
        if($buyer != null){
            $buyerData = array(
                'name' => $buyer->name,
                'remarks' => $buyer->remarks,
                'id' => $buyer->id,
                'is_sub_con' => $buyer->is_sub_con
            );
            return $buyerData;
        }
        return 'Error';
    }

    public function getMachineList(Request $request){
       /* $machines = MachineSetup::orderBy('name')
            ->where('status',  'A')
            ->where('trims_type_id', $request->trims_type_id)
            ->get();*/

        $status = 'A';
        $DropDownData = DB::table("machine_setups")->where("trims_type_id",$request->YarnTypeID)->where("status", $status)->pluck("name","id");
        return json_encode($DropDownData);
    }
}
