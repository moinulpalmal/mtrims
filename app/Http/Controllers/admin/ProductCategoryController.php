<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\ProductCategory;
use Illuminate\Http\Request;

class ProductCategoryController extends Controller
{
    public function index()
    {
        return view('admin.product.category');
    }

    public function getAllNotDeletedProductCategory()
    {
        return ProductCategory::getAllNotDeletedProductCategory();
    }

    public function saveCategory(Request $request)
    {
        $id = $request->get('id');
        if(!empty($id))
        {
            return ProductCategory::updateProductCategory($request);
        }
        else
        {
            return ProductCategory::insertProductCategory($request);
        }

    }

    public function updateCategory(Request $request)
    {
        return ProductCategory::getCategoryDetail($request);
    }

    public function activate(Request $request)
    {
        return ProductCategory::activateProductCategory($request);
    }

    public function inActivate(Request $request)
    {
        return ProductCategory::inActivateProductCategory($request);
    }

    public function fullDelete(Request $request)
    {
        return ProductCategory::deleteProductCategory($request);
    }
}
