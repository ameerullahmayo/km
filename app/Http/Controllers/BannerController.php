<?php

namespace App\Http\Controllers;

use App\Models\Banner;
use App\Models\Category;
use Illuminate\Http\Request;

class BannerController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $banners = Banner::get();

        return view('backend.banners.index',compact('banners'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('backend.banners.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'image' => 'required|image|mimes:jpeg,png,jpg,gif',
            // 'image_2' => 'required|image|mimes:jpeg,png,jpg,gif', // Maximum file size 2MB
        ]);
        $banner = new Banner();
        $banner->urdu_title = $request->urdu_title;
        $banner->english_title = $request->english_title;
        $banner->urdu_description = $request->urdu_description;
        $banner->english_description = $request->english_description;
        if($request->status){
            $banner->status = $request->status;
        }
        // $image->filename = $filename;
        // $image->path = 'category_images/' . $filename; // Store relative path
        if($request->hasfile('image'))
        {
            $file1 = $request->file('image');
            $uploadPath = public_path('banner_images');
            $filename1 = time(). '_' . $file1->getClientOriginalName();
            $file1->move($uploadPath, $filename1);
            $url = asset('banner_images/' . $filename1);
            
            $banner->image = $url;
        }
        // if($request->hasfile('image_2'))
        // {
        //      sleep(1);
        //     $file2 = $request->file('image_2');
        //     $filename2 = time() . '_' . $file2->getClientOriginalName();
        //     $file2->move($uploadPath, $filename2);
        //     $ur2 = asset('category_images/' . $filename2);
        //     $category->image_2 = $ur2;
        // }
        // $category->type= $category->type;
        // dd($request->all(),$category);
        $banner->save();
        return redirect()->route('banners.index')->with('success', 'Banner Created successfully!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Banner $banner)
    {
        $banner->delete();

         return redirect()->back()->with('success', 'Banner Deleted successfully!');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Banner $banner)
    {
        return view('backend.banners.edit',compact('banner'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Banner $banner)
    {
       
        $request->validate([
            'image' => 'image|mimes:jpeg,png,jpg,gif',
            // 'image_2' => 'image|mimes:jpeg,png,jpg,gif', // Maximum file size 2MB
        ]);

        $banner->urdu_title = $request->urdu_title;
        $banner->english_title = $request->english_title;
        $banner->urdu_description = $request->urdu_description;
        $banner->english_description = $request->english_description;
        if($request->status){

            $banner->status = $request->status;

        }else{
            $banner->status = 0;
        }
        // $image->filename = $filename;
        // $image->path = 'category_images/' . $filename; // Store relative path
        if($request->hasfile('image'))
        {
            $file1 = $request->file('image');
            $uploadPath = public_path('banner_images');
            $filename1 = time(). '_' . $file1->getClientOriginalName();
            $file1->move($uploadPath, $filename1);
            $url = asset('banner_images/' . $filename1);
            $banner->image = $url;
        }
        
        // if($request->hasfile('image_2'))
        // {
        //     sleep(1);
        //     $file2 = $request->file('image_2');
        //     $filename2 = time(). '_' . $file2->getClientOriginalName();
        //     $file2->move($uploadPath, $filename2);
        //     $ur2 = asset('category_images/' . $filename2);
        //     $category->image_2 = $ur2;
        // }

        // $category->type= $category->type;
    
        $banner->save();
        return redirect()->route('banners.index')->with('success', 'Banner Updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Banner $banner)
    {

        $banner->delete();

        return redirect()->back()->with('success', 'Banner Deleted successfully!');
    }
}
