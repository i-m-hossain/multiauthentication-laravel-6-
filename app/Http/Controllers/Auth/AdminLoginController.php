<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminLoginController extends Controller
{
    public function __construct(){
        $this->middleware('guest:admin')->except('logout');
    }

    public function showLoginForm(){
        return view('auth.admin-login');
    }
    public function login(Request $request ){
        //validate form data
        $this->validate($request,[
            'email'=>'required|string|email',
            'password'=>'required|string|min:8',

        ]);
        //Attempt to login as Admin
        if(Auth::guard('admin')->attempt(['email' => $request->email, 'password'=> $request->password], $request->remember)){
            //If successful then redirect to intended route or admin dashboard

            return redirect()->intended(route('admin.dashboard'));
        }
        //If unsuccessful then redirect to login page with email or remember field
        return redirect()->back()->with($request->only('email','remember'));
    }
    public function logout(){
        Auth::guard('admin')->logout();
        return redirect('/');
    }

}
