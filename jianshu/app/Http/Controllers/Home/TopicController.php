<?php

namespace App\Http\Controllers\Home;

use App\Post;
use App\Post_topic;
use App\Topic;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
class TopicController extends Controller
{
    //
    public function show(Topic $topic){

       $topic= Topic::withCount('posts')->find($topic->id);

       $posts=$topic->posts()->orderBy('created_at','desc')->paginate(2);


       $myPosts=\App\Post::authorBy(\Auth::id())->topicNotBy($topic->id)->get();

        return view('topic/show',compact('topic','posts','myPosts'));
    }
    public function submit(Request $request ,Topic $topic){

        $this->validate($request,[
           'post_ids'=>'required'
        ],[
            'post_ids.required'=>'至少选中一篇文章！'
        ]);
        $topic_id=$topic->id;

        foreach ($request->post_ids as $post_id){

            Post_topic::firstOrCreate(['post_id'=>$post_id,'topic_id'=>$topic_id]);
        }
        return back()->with('success','投稿成功！');
//        $post_id=$topic->post_id;
    }
}
