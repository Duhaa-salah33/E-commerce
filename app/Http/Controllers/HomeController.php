<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;


class HomeController extends Controller
{
    public function redirect()
    {
        // $usertype = Auth::user()->usertype;
        // if($usertype== '1')
        // {
        //     return view('admin.home');
        // }
        // else
        // {
        //     return view('home.userpage');
        // }

       
            if(!empty(Auth::user()) && Auth::user()->usertype == 1 ){
                return view('admin.home');
            }
            return view('home.userpage');
        
    }
    public function index()
    {
        return view('home.userpage');
    }


    // public function logout(Request $request)
    // {
    //     Auth::logout();
    //    $request->session()->invalidate();
     
    //     $request->session()->regenerateToken();
     
    //     return redirect('/');
    //     // Session::flush();
            
    //     //     Auth::logout();
    
    //     //     return redirect('login');
    // }

    
  
}




