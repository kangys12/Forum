<?php

namespace App\Http\Controllers\Home;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    //
    public function index (){
        return view('register/login');
    }
    public function dologin (Request $request){
        //$request->user();
        $this->validate(request(),[
            'email' => 'required|email|exists:users,email',
            'password' => 'required'
        ]);
        $email=$request->email;
        $password=$request->password;
        if (Auth::attempt(['email' => $email, 'password' => $password])){
            return redirect('/posts')->with('success','登录成功！');
        }else{
            return back()->with('error','登录失败！');

        }


        //dd($request);
        //return redirect('/posts','request');
    }
    public function logout(){
        Auth::logout();
        return redirect('/posts')->with('success','退出成功！');
    }
}
