<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Product;
use App\ProductBrand;
use App\ProductCategory;
use App\Unit;
use Illuminate\Http\Request;

class ProductSetupController extends Controller
{
    public function index()
    {
        // $brands = ProductBrand::orderBy('name')->where('status', '!=', 'D')->get();
        $categories = ProductCategory::orderBy('name')->where('status', '!=', 'D')->get();
        $units = Unit::orderBy('full_unit')->where('status', '!=', 'D')->get();
        return view('admin.product.setup', compact('categories','units'));
    }

    public function getAllNotDeletedProduct()
    {
        return Product::getAllNotDeletedProduct();
    }

    public function saveProduct(Request $request)
    {
        $id = $request->get('id');
        if(!empty($id))
        {
            return Product::updateProduct($request);
        }
        else
        {
            return Product::insertProduct($request);
        }

    }

    public function updateProduct(Request $request)
    {
        return Product::getProductDetail($request);
    }

    public function activate(Request $request)
    {
        return Product::activateProduct($request);
    }

    public function inActivate(Request $request)
    {
        return Product::inActivateProduct($request);
    }

    public function fullDelete(Request $request)
    {
        return Product::deleteProduct($request);
    }

    public function getProductUnit(Request $req)
    {
        return Product::getProdUnit($req);
    }
    
}
