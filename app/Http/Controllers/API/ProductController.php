<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\API\BaseController as BaseController;
use App\Models\Banner;
use App\Models\Audio;
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
        

        return $this->sendResponse('Categories List', $categories);
    }
    public function getProductsList(Request $request)
    {
       
        $products=Product::where('category_id',$request->categories)->with('category')->get();
        

        return $this->sendResponse('Products List',$products);
    }

    public function getProductDetails($id)
    {
       
        $product=Product::with('category')->where('id',$id)->first();
        

        return $this->sendResponse('Product Details',$product);
    }

    public function getBannersList(){

        $banners = Banner::get();

        return $this->sendResponse('Banners List' , $banners);
    }

    public function getAudiosList(){

        $audios = Audio::get();

        return $this->sendResponse('Audios List' , $audios);
    }

}
