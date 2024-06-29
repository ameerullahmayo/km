<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\API\BaseController as BaseController;

use Illuminate\Support\Facades\Auth;
use Validator;
use App\Models\Category;
use App\Models\Product;

class ProductController extends BaseController
{
    /**
     * Register api
     *
     * @return \Illuminate\Http\Response
     */
    public function getCategoreisList(Request $request)
    {
       
        $categories=Category::get();
        

        return $this->sendResponse($categories, 'Categories List');
    }
    public function getProductsList(Request $request)
    {
       
        $products=Product::where('category_id',$request->categories)->with('category')->get();
        

        return $this->sendResponse($products, 'Products List');
    }

    public function getProductDetails($id)
    {
       
        $product=Product::with('category')->where('id',$id)->first();
        

        return $this->sendResponse($product, 'Product Details');
    }

}
