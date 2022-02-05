<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MachineSetup extends Model{


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
        if($supplier->save()){
            return true;
        }
        return 'Error';
    }
}
