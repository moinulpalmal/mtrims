<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class Product extends Model
{
    public static function getAllNotDeletedProduct(){
        return DB::table('products')
            ->join('product_brands','product_brands.id', '=', 'products.product_brand_id')
            ->join('product_categories','product_categories.id', '=', 'products.product_category_id')
            ->join('units','units.id', '=', 'products.default_unit_id')
            ->select('product_brands.name AS brand_name', 'product_categories.name AS category_name', 
                'units.full_unit AS unit_name','products.name','products.remarks','products.status','products.id')
            ->where('products.status', '!=', 'D')
            ->orderBy('products.name')
            ->get();
    }

    public static function insertProduct($request){
        $model = new Product();
        $model->product_brand_id = $request->brand_name;
        $model->product_category_id = $request->category_name;
        $model->default_unit_id = $request->unit_name;
        $model->name = $request->name;
        $model->remarks = $request->remarks;
        $model->inserted_by = Auth::id();
        $model->status = 'A';
        if($model->save())
        {
            return '1';
        }
        return '0';
    }

    public static function updateProduct($request){
        $model = Product::find($request->id);
        if($model != null){
            $model->product_brand_id = $request->brand_name;
            $model->product_category_id = $request->category_name;
            $model->default_unit_id = $request->unit_name;
            $model->name = $request->name;
            $model->remarks = $request->remarks;
            $model->last_updated_by = Auth::id();
            if($model->save())
            {
                return '2';
            }
            return '0';
        }
        return '0';
    }

    public static function getProductDetail($request){
        $model =  Product::find($request->id);

        if($model == null)
            return null;

        $ProductData = array(
            'id' => $model->id,
            'brand_name' => $model->product_brand_id,
            'category_name' => $model->product_category_id,
            'unit_name' => $model->default_unit_id,
            'name' => $model->name,
            'remarks' => $model->remarks,
        );
        return $ProductData;
    }

    public static function activateProduct($request){
        $model = Product::find($request->id);
        $model->status = 'A';
        if($model->save())
        {
            return '2';
        }
        return '0';
    }

    public static function inActivateProduct($request){
        $model = Product::find($request->id);
        $model->status = 'I';
        if($model->save())
        {
            return '2';
        }
        return '0';
    }

    public static function deleteProduct($request){
        $model = Product::find($request->id);
        $model->status = 'D';
        if($model->save())
        {
            return '2';
        }
        return '0';
    }

}
