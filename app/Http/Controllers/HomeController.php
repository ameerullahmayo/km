<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
    //  */
    // public function __construct()
    // {
    //     $this->middleware('auth');
    // }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('home');
    }
     public function shop()
    {
        return view('shop');
    }
     public function shopDetail()
    {
        return view('shop_detail');
    }
     public function contact()
    {
        return view('contact');
    }
     public function testimonial()
    {
        return view('testimonial');
    }
     public function cart()
    {
        return view('cart');
    }
     public function checkout()
    {
        return view('checkout');
    }
    
}
