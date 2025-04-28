<?php

namespace App\Http\Controllers\Auth;
use Auth;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;


class AdminLoginController extends Controller
{
    public function __construct(){
        $this->middleware('guest');
    }
    public function showloginform(){
        return view('auth.admin-login');
    }
    public function login(Request $request){
        $this->validate($request,[
            'email'=>'required|email',
            'password'=> 'required|min:5'
        ]);

       if(Auth::guard('admin')->attempt(['email'=>$request->email,'password'=>$request->password],$request->remember)){
          return redirect()->intended(route('admin'));
           
       }
       else
       return redirect()->back()->withInput($request->only('email','remember'));
       
    }

    public function logout(Request $request) {
        Auth::guard('admin')->logout();
        $request->session()->flush();
        $request->session()->regenerate();
        return redirect()->guest(route( 'auth.admin-login' ));
      }
}
