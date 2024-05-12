<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $categories=Category::get();
        return view('backend.categoris.index',compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('backend.categoris.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'image_1' => 'required|image|mimes:jpeg,png,jpg,gif',
            'image_2' => 'required|image|mimes:jpeg,png,jpg,gif', // Maximum file size 2MB
        ]);
        $category = new Category();
        $category->english_title = $request->english_title;
        $category->urdu_title = $request->urdu_title;
        if($request->status){
            $category->status = $request->status;
        }
        // $image->filename = $filename;
        // $image->path = 'category_images/' . $filename; // Store relative path
        if($request->hasfile('image_2'))
        {
            $file1 = $request->file('image_1');
            $uploadPath = public_path('category_images');
            $filename1 = time(). '_' . $file1->getClientOriginalName();
            $file1->move($uploadPath, $filename1);
            $url = asset('category_images/' . $filename1);
            
            $category->image_1 = $url;
        }
        if($request->hasfile('image_2'))
        {
             sleep(1);
            $file2 = $request->file('image_2');
            $filename2 = time() . '_' . $file2->getClientOriginalName();
            $file2->move($uploadPath, $filename2);
            $ur2 = asset('category_images/' . $filename2);
            $category->image_2 = $ur2;
        }
        // $category->type= $category->type;
        // dd($request->all(),$category);
        $category->save();
        return redirect()->route('categories.index')->with('success', 'Category Created successfully!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Category $category)
    {
        $category->delete();

         return redirect()->back()->with('success', 'Category Deleted successfully!');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Category $category)
    {
        return view('backend.categoris.edit',compact('category'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Category $category)
    {
       
        $request->validate([
            'image_1' => 'image|mimes:jpeg,png,jpg,gif',
            'image_2' => 'image|mimes:jpeg,png,jpg,gif', // Maximum file size 2MB
        ]);

        $category->english_title = $request->english_title;
        $category->urdu_title = $request->urdu_title;
        if($request->status){

            $category->status = $request->status;

        }else{
            $category->status = 0;
        }
        // $image->filename = $filename;
        // $image->path = 'category_images/' . $filename; // Store relative path
        if($request->hasfile('image_1'))
        {
            $file1 = $request->file('image_1');
            $uploadPath = public_path('category_images');
            $filename1 = time(). '_' . $file1->getClientOriginalName();
            $file1->move($uploadPath, $filename1);
            $url = asset('category_images/' . $filename1);
            $category->image_1 = $url;
        }
        
        if($request->hasfile('image_2'))
        {
            sleep(1);
            $file2 = $request->file('image_2');
            $filename2 = time(). '_' . $file2->getClientOriginalName();
            $file2->move($uploadPath, $filename2);
            $ur2 = asset('category_images/' . $filename2);
            $category->image_2 = $ur2;
        }

        // $category->type= $category->type;
    
        $category->save();
        return redirect()->route('categories.index')->with('success', 'Category Updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Category $category)
    {

        $category->delete();

        return redirect()->back()->with('success', 'Category Deleted successfully!');
    }
}
