<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class MachineSetup extends Model{

    public static function getAllNotDeletedMachines(){
        $data = DB::table('machine_setups')
            ->join('section_setups', 'section_setups.id', '=', 'machine_setups.section_setup_id')
            ->select('section_setups.name AS section_setup_name',
            'machine_setups.id', 'machine_setups.name', 'machine_setups.remarks',
                'machine_setups.active_hours', 'machine_setups.status')
            ->where('machine_setups.status', '!=', 'D')
            ->orderBy('section_setups.name', 'ASC')
            ->orderBy('machine_setups.name', 'ASC')
            ->get();

        return $data;
    }

    public static function getActiveMachineCount(){
        return MachineSetup::where('status', '!=', 'D')->get()->count();
    }

    public static function getActiveMachineCountSectionSetup($sectionID){
        return MachineSetup::where('status', '!=', 'D')
            ->where('section_setup_id', $sectionID)
            ->get()
            ->count();
    }

    public static function insertMachine($request){
        $supplier = new MachineSetup();
        $supplier->name = $request->name;
        //$supplier->trims_type_id = $request->trims_type;
        $supplier->section_setup_id = $request->section;
        $supplier->remarks = $request->remarks;
        $supplier->active_hours = $request->active_hours;
        $supplier->inserted_by = Auth::id();
        if($supplier->save())
        {
            return '1';
        }
        return '0';
    }

    public static function updateMachine($request){
        $supplier = MachineSetup::find($request->id);
        if($supplier != null){
            $supplier->name = $request->name;
            //$supplier->trims_type_id = $request->trims_type;
            $supplier->section_setup_id = $request->section;
            $supplier->remarks = $request->remarks;
            $supplier->active_hours = $request->active_hours;
            $supplier->last_updated_by = Auth::id();
            if($supplier->save())
            {
                return '2';
            }
        }
        return '0';
    }

    public static function activateMachine($request){
        $supplier = MachineSetup::find($request->id);
        $supplier->status = 'A';
        $supplier->last_updated_by = Auth::id();
        if($supplier->save()){
            return '2';
        }
        return '0';
    }

    public static function inActivateMachine($request){
        $supplier = MachineSetup::find($request->id);
        $supplier->status = 'I';
        $supplier->last_updated_by = Auth::id();
        if($supplier->save()){
            return '2';
        }
        return '0';
    }

    public static function deleteMachine($request){
        $supplier = MachineSetup::find($request->id);
        $supplier->status = 'D';
        $supplier->last_updated_by = Auth::id();
        if($supplier->save()){
            return '2';
        }
        return '0';
    }

    public static function returnForUpdate($req){
        $model = MachineSetup::find($req->id);
        if($model != null){
            $modelData = array(
                'name' => $model->name,
                'remarks' => $model->remarks,
                'section' => $model->section_setup_id,
                'id' => $model->id,
                'active_hours' => $model->active_hours
            );
            return $modelData;
        }
        return null;
    }
}
