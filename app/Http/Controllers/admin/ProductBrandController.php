<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\ProductBrand;
use Illuminate\Http\Request;

class ProductBrandController extends Controller
{
    public function index()
    {
        return view('admin.product.brand');
    }

    public function getAllNotDeletedProductBrands()
    {
        return ProductBrand::getAllNotDeletedProductBrands();
    }

    public function saveBrand(Request $request)
    {
        $id = $request->get('id');
        if(!empty($id))
        {
            return ProductBrand::updateProductBrand($request);
        }
        else
        {
            return ProductBrand::insertProductBrand($request);
        }

    }

    public function updateBrand(Request $request)
    {
        return ProductBrand::getBrandDetail($request);
    }

    public function activate(Request $request)
    {
        return ProductBrand::activateProductBrand($request);
    }

    public function inActivate(Request $request)
    {
        return ProductBrand::inActivateProductBrand($request);
    }

    public function fullDelete(Request $request)
    {
        return ProductBrand::deleteProductBrand($request);
    }



}
