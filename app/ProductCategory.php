<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class ProductCategory extends Model
{
    public static function getAllNotDeletedProductCategory(){
        return DB::table('product_categories')
            ->select('*')
            ->where('status', '!=', 'D')
            ->orderBy('name')
            ->get();
    }

    public static function insertProductCategory($request){
        $model = new ProductCategory();
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

    public static function updateProductCategory($request){
        $model = ProductCategory::find($request->id);
        if($model != null){
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

    public static function getCategoryDetail($request){
        $model =  ProductCategory::find($request->id);

        if($model == null)
            return null;

        $CategoryData = array(
            'id' => $model->id,
            'name' => $model->name,
            'remarks' => $model->remarks,
        );
        return $CategoryData;
    }

    public static function activateProductCategory($request){
        $model = ProductCategory::find($request->id);
        $model->status = 'A';
        if($model->save())
        {
            return '2';
        }
        return '0';
    }

    public static function inActivateProductCategory($request){
        $model = ProductCategory::find($request->id);
        $model->status = 'I';
        if($model->save())
        {
            return '2';
        }
        return '0';
    }

    public static function deleteProductCategory($request){
        $model = ProductCategory::find($request->id);
        $model->status = 'D';
        if($model->save())
        {
            return '2';
        }
        return '0';
    }

    
}
