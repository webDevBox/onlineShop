<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class AuthController extends Controller
{
    //Login
    public function login(Request $request)
    {
        if(isset($request->email) && isset($request->password))
        {
            $cred=$request->only('email','password');
            if(Auth::attempt($cred))
            {
                if(Auth::check())
                {
                    if(Auth::user()->userRole == 1)
                    {
                        $status=1;
                    return redirect('/dashboard')->with('status',$status);
                    }
                    else
                    {
                        return redirect()->back()->with('error','You are not Allow to Login');
                    }
                }
            }
            else
            {
                return redirect()->back()->with('error','Wrong Credentials');    
            }
        }
        else
        {
            return redirect()->back()->with('error','Wrong Credentials');
        }
    }
    //Logout
    public function logout()
    {
        Auth::logout();
        return redirect('/');
    }
   
}
