<?php

namespace App\Http\Controllers\admin;

use App\Department;
use App\Factory;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DepartmentController extends Controller
{
    public function index(){
        $departments = Department::orderBy('name')->get();
        $factories = Factory::orderBy('name')->get();
        return view('admin.department.index', compact('departments', 'factories'));
    }

    public function getAllNotDeletedDepartments(){
        return Department::getAllNotDeletedDepartments();
    }

    public function saveDepartment(Request $req){
        if(!empty($req->get('id')))
        {
            return Department::updateDepartment($req);
        }
        else
        {
            return Department::insertDepartment($req);
        }

    }

    public function updateDepartment(Request $req)
    {
        return Department::returnUpdateDepartment($req);
    }

    public function getDepartmentListByFactoryForSelect(Request $request){
        $status = 'A';
        $DropDownData = DB::table('departments')
            ->where('factory_id', $request->factory_id)
            ->where('status', $status)
            ->pluck("name","id");

        return json_encode($DropDownData);
    }
}
