<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class ProductBrand extends Model
{
    public static function getAllNotDeletedProductBrands(){
        return DB::table('product_brands')
            ->select('*')
            ->where('status', '!=', 'D')
            ->orderBy('name')
            ->get();
    }

    public static function insertProductBrand($request){
        $supplier = new ProductBrand();
        $supplier->name = $request->name;
        $supplier->remarks = $request->remarks;
        $supplier->inserted_by = Auth::id();
        $supplier->status = 'A';
        if($supplier->save())
        {
            return '1';
        }
        return '0';
    }

    public static function updateProductBrand($request){
        $supplier = ProductBrand::find($request->id);
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

    public static function getBrandDetail($request){
        $supplier =  ProductBrand::find($request->id);

        if($supplier == null)
            return null;

        $brandData = array(
            'id' => $supplier->id,
            'name' => $supplier->name,
            'remarks' => $supplier->remarks,
        );
        return $brandData;
    }

    public static function activateProductBrand($request){
        $supplier = ProductBrand::find($request->id);
        $supplier->status = 'A';
        if($supplier->save())
        {
            return '2';
        }
        return '0';
    }

    public static function inActivateProductBrand($request){
        $supplier = ProductBrand::find($request->id);
        $supplier->status = 'I';
        if($supplier->save())
        {
            return '2';
        }
        return '0';
    }

    public static function deleteProductBrand($request){
        $supplier = ProductBrand::find($request->id);
        $supplier->status = 'D';
        if($supplier->save())
        {
            return '2';
        }
        return '0';
    }
}
