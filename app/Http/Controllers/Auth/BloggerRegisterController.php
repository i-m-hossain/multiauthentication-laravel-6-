<?php

namespace App\Http\Controllers\Auth;


use App\Blogger;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class BloggerRegisterController extends Controller
{
    public function __construct(){
        $this->middleware('guest:blogger');
    }
    public function showRegistrationForm(){
        return view('auth.blogger-register');
    }
    public function register(Request $request){
        //validate Form data
        $this->validate($request,
            [
                'name'=> ['required', 'string', 'max: 255'],
                'email'=> ['required', 'string', 'email', 'max: 255', 'unique:admins'],
                'password'=> ['required', 'string', 'min:8']

            ]
        );
        //Create Admin user

        try{
            $blogger = Blogger::create([
                'name'=> $request->name,
                'email'=> $request->email,
                'password'=> Hash::make($request->password),

            ]);
            //Log the admin in
            Auth::guard('blogger')->loginUsingId($blogger->id);
            return redirect()->route('blogger.dashboard');

        }catch (\Exception $e ){
            return redirect()->back()->withInput($request->only('name', 'email'));
        }

    }
}
