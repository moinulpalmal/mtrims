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
        $model = new ProductBrand();
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

    public static function updateProductBrand($request){
        $model = ProductBrand::find($request->id);
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

    public static function getBrandDetail($request){
        $model =  ProductBrand::find($request->id);

        if($model == null)
            return null;

        $brandData = array(
            'id' => $model->id,
            'name' => $model->name,
            'remarks' => $model->remarks,
        );
        return $brandData;
    }

    public static function activateProductBrand($request){
        $model = ProductBrand::find($request->id);
        $model->status = 'A';
        if($model->save())
        {
            return '2';
        }
        return '0';
    }

    public static function inActivateProductBrand($request){
        $model = ProductBrand::find($request->id);
        $model->status = 'I';
        if($model->save())
        {
            return '2';
        }
        return '0';
    }

    public static function deleteProductBrand($request){
        $model = ProductBrand::find($request->id);
        $model->status = 'D';
        if($model->save())
        {
            return '2';
        }
        return '0';
    }
}
