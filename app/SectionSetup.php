<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class SectionSetup extends Model
{
   public static function getSectionSetupsForSelect(){
       return DB::table('section_setups')
                ->select('id', 'name')
                ->where('status', '=', 'A')
                ->orderBy('name', 'ASC')
                ->get();
   }

   public static function getAllNotDeletedSections(){
      return DB::table('section_setups')
          ->select('*')
          ->where('status', '!=', 'D')
          ->orderBy('name')
          ->get();
  }

  public static function insertSectionSetup($request){
      $supplier = new SectionSetup();
      $supplier->name = $request->name;
      $supplier->remarks = $request->remarks;
      $supplier->status = 'A';
      $supplier->inserted_by = Auth::id();
      if($supplier->save())
      {
         return '1';
      }
      return '0';
  }

  public static function updateSectionSetup($request){
      $supplier = SectionSetup::find($request->id);
      if($supplier != null){
            $supplier->name = $request->name;
            $supplier->remarks = $request->remarks;
            $supplier->last_updated_by = Auth::id();
            if($supplier->save())
            {
               return '2';
            }
            return '0';
      }
      return '0';
  }

  public static function activateSectionSetup($request){
      $supplier = SectionSetup::find($request->id);
      $supplier->status = 'A';
      $supplier->last_updated_by = Auth::id();
      if($supplier->save()){
         return '2';
      }
      return '0';
  }

  public static function inActivateSectionSetup($request){
      $supplier = SectionSetup::find($request->id);
      $supplier->status = 'I';
      $supplier->last_updated_by = Auth::id();
      if($supplier->save()){
         return '2';
      }
      return '0';
  }

  public static function deleteSectionSetup($request){
      $supplier = SectionSetup::find($request->id);
      $supplier->status = 'D';
      $supplier->last_updated_by = Auth::id();
      if($supplier->save()){
         return '2';
      }
      return '0';
  }



}
