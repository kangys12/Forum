<?php

namespace App\Http\Controllers\Home;

use App\Fan;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;
use App\User;
class UserController extends Controller
{
    //
    public  function index(){
        return view('user/index');
    }
    public  function setting(Request $request ,$id){
        $user=User::find($id);
//修改名字
        $user->name=$request->name;
//有没有上传头像
        if ($request->hasFile('photo')){
            $path=$request->photo->store('');

            //Storage::delete(User::select('photo')->find($id)->toArray()['photo']);
            //删除已存在头像
            Storage::delete(Auth::user()->photo);
            $user->photo=$path;
        }
//执行修改
        $res=$user->save();
        if ($res){
            return back()->with('success','头像上传成功！');
        }else{
            return back()->with('error','头像上传失败！');

        }

    }


    public function show(User $user){
        $user=User::withCount(['posts','stars','fans'])->find($user->id);
        $posts=$user->posts()->orderBy('created_at','desc')->take(5)->get();


            // 这个人关注的用户，包含关注用户的  【关注、粉丝、文章数】
        //我作为stars明星
        $stars = $user->stars;
        //查询粉丝数
        $susers = User::whereIn('id', $stars->pluck('fan_id'))->withCount(['posts','stars','fans'])->get();
        //我作为fans粉丝
        $fans = $user->fans;
        //查询关注明星数
        $fusers = User::whereIn('id', $fans->pluck('star_id'))->withCount(['posts','stars','fans'])->get();
        return view('user/page',compact('user','posts','susers','fusers'));
    }

    public function fan(User $user){
        $fan_id=\Auth::id();

        $star_id=$user->id;
        Fan::create(['fan_id'=>$fan_id,'star_id'=>$star_id]);
        return 'no';
    }
    public function unfan(User $user){
        $fan_id=\Auth::id();

        $star_id=$user->id;
        Fan::where('fan_id', $fan_id)->where('star_id',$star_id)->delete();
        return 'ok';
    }
}
