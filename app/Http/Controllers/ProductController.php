<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use App\Models\Category;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {

        $products = Product::get();

        return view('backend.products.index',compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {

        $categories=Category::get();

        return view('backend.products.create',compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // dd($request->all());
        
        $product = new Product();

        $product->english_title = $request->english_title;
        $product->urdu_title = $request->urdu_title;
        $product->english_description = $request->english_description;
        $product->urdu_description = $request->urdu_description;
        if($request->status){
            $product->status = $request->status;
        }
        $product->price = $request->price;
        $product->sale_price = $request->sale_price;
        $product->quantity = $request->quantity;
        $product->weight = $request->weight;
        $product->english_type = $request->english_type;
        $product->urdu_type = $request->urdu_type;
        $images = [];

         if ($request->hasFile('images')) {
            foreach ($request->file('images') as $file) {
                    sleep(1); // Simulate delay (optional)
            $uploadPath = public_path('product_images');
            $filename = time() . '_' . $file->getClientOriginalName();
            $file->move($uploadPath, $filename);
            $url = asset('product_images/' . $filename);
            array_push($images, $url);
        }
    }

        $product->images= json_encode($images);
        $product->category_id = $request->category_id;
        // dd($request->all(),$product);
        $product->save();
        return redirect()->route('products.index')->with('success', 'Product Created successfully!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Product $product)
    {
        $product->delete();
        return redirect()->route('products.index')->with('success', 'Product Deleted successfully!');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Product $product)
    {
        $categories=Category::get();

        return view('backend.products.edit',compact('categories','product'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Product $product)
    {


        $product->english_title = $request->english_title;
        $product->urdu_title = $request->urdu_title;
        $product->english_description = $request->english_description;
        $product->urdu_description = $request->urdu_description;
        if($request->status){
            $product->status = $request->status;
        }else{
            $product->status = 0;
        }
        $product->price = $request->price;
        $product->sale_price = $request->sale_price;
        $product->quantity = $request->quantity;
        $product->weight = $request->weight;
        $product->english_type = $request->english_type;
        $product->urdu_type = $request->urdu_type;
        $images = [];

         if ($request->hasFile('images')) {
            foreach ($request->file('images') as $file) {
                    sleep(1); // Simulate delay (optional)
            $uploadPath = public_path('product_images');
            $filename = time() . '_' . $file->getClientOriginalName();
            $file->move($uploadPath, $filename);
            $url = asset('product_images/' . $filename);
            array_push($images, $url);
        }
    }
    if(!empty($images)){
         $product->images= json_encode($images);
    }
       
        $product->category_id = $request->category_id;
        // dd($request->all(),$product);
        $product->save();
        $product->save();
        return redirect()->route('products.index')->with('success', 'Product Update successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Product $product)
    {
        //
    }
}
