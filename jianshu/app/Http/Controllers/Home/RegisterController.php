<?php

namespace App\Http\Controllers\Home;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\User;

class RegisterController extends Controller
{
    //
    public function index(){

        return view('register/index');

    }
    public function register(Request $request){
        $this->validate(request(),[
            'name' => 'required|string|min:2|max:4|unique:users,name',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|confirmed|min:6|max:16'
        ]);
        $name=$request->name;
        $email=$request->email;
        $password=bcrypt($request->password);
        $res=User::create(['name'=>$name, 'email'=>$email,'password'=>$password]);
        if ($res){
            return redirect('/login')->with('success','发布成功！');
        }else{
            return back()->with('error','发布失败！');
        }

    }
}
