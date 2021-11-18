<?php

namespace App\Http\Controllers\admin;

use App\Department;
use App\Factory;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class DepartmentController extends Controller
{
    public function index(){
        $departments = Department::orderBy('name')->get();
        $factories = Factory::orderBy('name')->get();
        return view('admin.department.index', compact('departments', 'factories'));
    }

    public function saveDepartment(Request $req)
    {
        $HiddenDepartmentID = $req->get('id');
        if(!empty($HiddenDepartmentID))
        {

            $department = Department::find($HiddenDepartmentID);

            if($department != null){
                $department->name = $req->get('name');
                $department->factory_id = $req->get('factory_name');
                $department->short_name = $req->get('short_name');
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
                    return 'Updated';
                }
            }
            return 'Error';
        }
        else
        {
            $department = new Department();
            $department->name = $req->get('name');
            $department->factory_id = $req->get('factory_name');
            $department->short_name = $req->get('short_name');
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
                return 'Saved';
            }
        }
        return 'Error';
    }

    public function updateDepartment(Request $req)
    {
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
        return 'Error';
    }
}
