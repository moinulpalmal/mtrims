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

    public function deleteDepartment(Request $request){
        return Department::deleteDepartment($request);
    }

    public function activateDepartment(Request $request){
        return Department::activateDepartment($request);
    }

    public function deActivateDepartment(Request $request){
        return Department::deActivateDepartment($request);
    }

    public function getDepartmentListByFactoryForSelect(Request $request){
        return Department::getJasonDepartmentListByFactory($request);
    }
}
