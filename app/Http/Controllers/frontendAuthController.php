<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class frontendAuthController extends Controller
{
    public function getForm(){
        return view('auth.signin');
    }

    public function doSignin(){
        if(auth()->guard('customer')->attempt(array('email' => request()->email, 'password' => request()->password)))
        {
            return redirect()->route('customer.index');   
        }else{
            return redirect()->route('signin')->with('error','Email-Address And Password Are Wrong.');
        }
    }

    public function doSignout(){
        \Auth::logout();
        request()->session()->flush();
        return redirect()->route('signin');
    }
}
