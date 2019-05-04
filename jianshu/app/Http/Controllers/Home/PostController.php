<?php

namespace App\Http\Controllers\Home;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Post;
use App\Comments;
use App\Zan;
use Illuminate\Support\Facades\Auth;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $posts=Post::orderBy('created_at' ,'desc')->withCount(['comments','zans'])->paginate(5);
        //dump($posts);
        return view('post/index',compact('posts'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('post/create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
//        $post = new Post();
//        $post->title = request('title');
//        $post->content = request('content');
//        $post->save();
        $this->validate($request,[
            'title' => 'required|string|max:55|min:5',
            'content' => 'required|string|min:10',
        ]);
        $id=Auth::id();
        $res=Post::create(['title'=>request('title'), 'content'=>request('content'),'user_id'=>$id]);
        if ($res){
            return redirect('/posts')->with('success','发布成功！');
        }else{
            return back()->with('error','发布失败！');

        }
        //return redirect();
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Post $post )
    {
        //

        return view('post/show',compact('post'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Post $post)
    {
        //
        $id=Auth::id();
        return view('post/edit',compact('post'));

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Post $post)
    {
        //
        $this->validate($request,[
            'title' => 'required|string|max:55|min:5',
            'content' => 'required|string|min:10',
        ]);
        $this->authorize('update', $post);
        $post->title=request('title');
        $post->content=request('content');
        $res=$post->save();
        if ($res){
            return redirect("/posts/{$post->id}")->with('success','修改成功！');
        }else{
            return back()->with('error','修改失败！');

        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function delete(Post $post)
    {
        //
        $this->authorize('delete', $post);
       $res=$post->delete();
        if ($res){
            return redirect("/posts")->with('success','删除成功！');
        }else{
            return back()->with('error','删除失败！');

        }
    }
    //评论
    public function comment(Request $request ,$id ,Comments $comments){
        if (!Auth::check()){
            return redirect('/login')->with('error','登录后再评论！');
        }
        $this->validate($request,[
            'content' => 'required|min:5',
        ]);
        $comments->post_id=$id;
        $comments->user_id=Auth::id();
        $comments->content=$request->content;
        $res=$comments->save();
        if ($res){
            return back()->with('success','发表成功！');
        }else{
            return back()->with('error','发表失败！');
        }
    }
    //点赞
    public function zan(Post $post){
//        if (!Auth::check()){
//            return redirect('/login')->with('error','登录后再评论！');
//        }

//        $res=Zan::create(['post_id'=>$id,'user_id'=>Auth::id()]);
//        if ($res){
//            return back()->with('success','点赞成功！');
//        }else{
//            return back()->with('error','点赞失败！');
//        }
        $params=[
          'post_id'=>$post->id,
          'user_id'=>\Auth::id()
        ];
        Zan::firstOrCreate($params);
         return back()->with('success','点赞成功！');
    }
    public function cancel(Post $post){
        $res=$post->zan(Auth::id())->delete();
        if ($res){
            return back()->with('success','取消成功！');
        }else{
            return back()->with('error','取消失败！');
        }
    }
}
