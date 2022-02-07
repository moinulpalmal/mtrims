<?php

namespace App\Http\Controllers\Production;

use App\Http\Controllers\Controller;
use App\MachineSetup;
use App\SectionSetup;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class MachineController extends Controller
{
    public function index(){
        $section_setups = SectionSetup::getSectionSetupsForSelect();
        return view('production.machine.index', compact('section_setups'));
    }

    public function getAllNotDeletedMachines(){
       return MachineSetup::getAllNotDeletedMachines();
    }

    public function saveMachine(Request $request){
        $id = $request->get('id');
        if(!empty($id))
        {
            return MachineSetup::updateMachine($request);
        }
        else
        {
            return MachineSetup::insertMachine($request);
        }
    }

    public function fullDelete(Request $request)
    {
        return MachineSetup::deleteMachine($request);
    }

    public function activate(Request $request)
    {
        return MachineSetup::activateMachine($request);
    }

    public function inActivate(Request $request)
    {
       return MachineSetup::inActivateMachine($request);
    }

    public function updateMachine(Request $req)
    {
        return MachineSetup::returnForUpdate($req);
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
