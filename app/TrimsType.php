<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class TrimsType extends Model
{
    public static function getAllNotDeletedTrimsTyps(){
        return DB::table('trims_types')
            ->select('*')
            ->where('status','!=', 'D')
            ->orderBy('name')
            ->get();
    }

    public static function GetAllActiveTrimsTypesForSelectField(){
        return DB::table('trims_types')
            ->select('id', 'name')
            ->where('status','!=', 'D')
            ->orderBy('name', 'ASC')
            ->get();
    }

    public static function GetLpdActiveTrimsTypesForSelectField($lpd){
        return DB::table('trims_types')
            ->select('id', 'name')
            ->where('status','!=', 'D')
            ->where('lpd',$lpd)
            ->orderBy('name', 'ASC')
            ->get();
    }

    public static function GetTrimsTypeName($id){
        return DB::table('trims_types')
            ->select('id', 'name')
            ->where('id', $id)
            ->first();
    }

    public static function insertTrimsType($request){
        $supplier = new TrimsType();
        $supplier->name = $request->name;
        $supplier->description = $request->description;
        $supplier->section_setup_id = $request->section;
        $supplier->remarks = $request->remarks;
        $supplier->lpd = $request->lpd;
        $supplier->short_name = $request->short_name;
        $supplier->gross_calculation_amount = $request->gross_calculation_amount;
        $supplier->inserted_by = Auth::id();
        $supplier->status = 'A';
        if($request->add_amount_percent != 0 || $request->add_amount_percent != null){
            $supplier->add_amount_percent = $request->add_amount_percent;
        }
        if($supplier->save())
        {
            return '1';
        }
        return '0';
    }

    public static function updateTrims($request){
        $supplier = TrimsType::find($request->id);
        if($supplier != null){
            $supplier->name = $request->name;
            $supplier->description = $request->description;
            $supplier->section_setup_id = $request->section;
            $supplier->remarks = $request->remarks;
            $supplier->short_name = $request->short_name;
            $supplier->last_updated_by = Auth::id();
            $supplier->gross_calculation_amount = $request->gross_calculation_amount;
            if($request->add_amount_percent != 0 || $request->add_amount_percent != null){
                $supplier->add_amount_percent = $request->add_amount_percent;
            }
            $supplier->lpd = $request->lpd;
            if($supplier->save())
            {
                return '2';
            }
            return '0';
        }
        return '0';
    }

    public static function getTrimsTypeDetail($request){
        $supplier =  TrimsType::find($request->id);
        if($supplier == null)
            return null;
        $supplierData = array(
            'id' => $supplier->id,
            'name' => $supplier->name,
            'short_name' => $supplier->short_name,
            'gross_calculation_amount' => $supplier->gross_calculation_amount,
            'add_amount_percent' => $supplier->add_amount_percent,
            'description' => $supplier->description,
            'section' => $supplier->section_setup_id,
            'lpd' => $supplier->lpd,
            'remarks' => $supplier->remarks,
            'status' => $supplier->status
        );
        return $supplierData;
    }

    public static function activateTrimsType($request){
        $supplier = TrimsType::find($request->id);
        $supplier->status = 'A';
        $supplier->last_updated_by = Auth::id();
        if($supplier->save()){
            return '2';
        }
        return '0';
    }

    public static function inActivateTrimsType($request){
        $supplier = TrimsType::find($request->id);
        $supplier->status = 'I';
        $supplier->last_updated_by = Auth::id();
        if($supplier->save()){
            return '2';
        }
        return '0';
    }

    public static function deleteTrimsType($request){
        $supplier = TrimsType::find($request->id);
        $supplier->status = 'D';
        $supplier->last_updated_by = Auth::id();
        if($supplier->save()){
            return '2';
        }
        return '0';
    }




}
