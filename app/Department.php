<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class Department extends Model
{
    public static function getAllNotDeletedDepartments(){
        return DB::table('departments')
                ->join('factories', 'factories.id', '=', 'departments.factory_id')
                ->select('factories.name AS factory_name', 'departments.name',
                    'departments.short_name', 'departments.id', 'departments.status',
                    'departments.is_merchandising_department')
                ->where('departments.status', '!=', 'D')
                ->orderBy('factories.name', 'ASC')
                ->orderBy('departments.name', 'ASC')
                ->get();
    }

    public static function insertDepartment($req){
        $department = new Department();
        $department->name = $req->get('name');
        $department->factory_id = $req->get('factory_name');
        $department->short_name = $req->get('short_name');
        $department->inserted_by = Auth::id();
        if($req->get('IsMerchandising') == 'on')
        {
            $department->is_merchandising_department = true;
        }
        else
        {
            $department->is_merchandising_department = false;
        }

        if($department->save())
        {
            return '1';
        }

        return '0';
    }

    public static function updateDepartment($req){
        $department = Department::find($req->get('id'));
        if(!empty($department)){
            $department->name = $req->get('name');
            $department->factory_id = $req->get('factory_name');
            $department->short_name = $req->get('short_name');
            $department->last_updated_by = Auth::id();
            if($req->get('IsMerchandising') == 'on')
            {
                $department->is_merchandising_department = true;
            }
            else
            {
                $department->is_merchandising_department = false;
            }

            if($department->save())
            {
                return '2';
            }

            return '0';
        }
        return '0';
    }

    public static function deleteDepartment($req){
        $department = Department::find($req->get('id'));
        if(!empty($department)){
            $department->status = 'D';
            $department->last_updated_by = Auth::id();
            if($department->save()){
                return '2';
            }
        }
        return false;
    }

    public static function activateDepartment($req){
        $department = Department::find($req->get('id'));
        if(!empty($department)){
            $department->status = 'A';
            $department->last_updated_by = Auth::id();
            if($department->save()){
                return '2';
            }
        }
        return '0';
    }

    public static function deActivateDepartment($req){
        $department = Department::find($req->get('id'));
        if(!empty($department)){
            $department->status = 'I';
            $department->last_updated_by = Auth::id();
            if($department->save()){
                return '2';
            }
        }
        return '0';
    }

    public static function returnUpdateDepartment($req){
        $department = Department::find($req->id);
        if($department != null){
            $departmentData = array(
                'name' => $department->name,
                'factory_name' => $department->factory_id,
                'IsMerchandising' => $department->is_merchandising_department,
                'short_name' => $department->short_name,
                'id' => $department->id
            );
            return $departmentData;
        }

        return null;
    }

    public static function getAllDepartmentsByFactoriesForSelect($factory_id){
        return DB::table('departments')
            ->select('departments.name', 'departments.id')
            ->where('departments.status', '=', 'A')
            ->where('departments.factory_id', '=', $factory_id)
            ->orderBy('departments.name', 'ASC')
            ->get();
    }

    public static function getJasonDepartmentListByFactory($request){
        $status = 'A';
        $DropDownData = DB::table('departments')
            ->where('factory_id', $request->factory_id)
            ->where('status', $status)
            ->pluck("name","id");

        return json_encode($DropDownData);
    }
}
