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
}
