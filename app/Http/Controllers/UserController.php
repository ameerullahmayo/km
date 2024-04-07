<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index(){
        $users=User::where('role','user')->get();
        return view('backend.users.index',compact('users'));
    }

}
