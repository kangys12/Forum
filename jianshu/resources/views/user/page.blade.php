@extends('layout.public')
@section('title')文章创建 @endsection
@section('main')
    <div class="col-sm-8">
        <blockquote>
            <p>
                @if($user->photo!='')
                <img src="/image/{{$user->photo}}" alt="" class="img-rounded" style="border-radius:500px; height: 40px">
                @else
                    <img src="/image/default.jpg" alt="" class="img-rounded" style="border-radius:500px; height: 40px">
                @endif
                    {{$user->name}}
            </p>


            <footer>关注：{{$user->fans_count}}｜粉丝：{{$user->stars_count}}｜文章：{{$user->posts_count}}</footer>
            <br>
            @include('user/but/button',['target_user'=>$user])

        </blockquote>
    </div>
<div class="col-sm-8 blog-main">
    <div class="nav-tabs-custom">
        <ul class="nav nav-tabs">
            <li class="active"><a href="#tab_1" data-toggle="tab" aria-expanded="true">文章</a></li>
            <li class=""><a href="#tab_2" data-toggle="tab" aria-expanded="false">关注</a></li>
            <li class=""><a href="#tab_3" data-toggle="tab" aria-expanded="false">粉丝</a></li>
        </ul>
        <div class="tab-content">
            <div class="tab-pane active" id="tab_1">
                @foreach($posts as $post)
                <div class="blog-post" style="margin-top: 30px">
                    <p class=""><a href="/user/{{$post->user->id}}">{{$post->user->name}}</a> {{$post->created_at->diffForHumans()}}</p>
                    <p class=""><a href="/posts/{{$post->id}}" >{{$post->title}}</a></p>
                    {!! str_limit($post->content,99,'<a href="/posts/'.$post->id.'">查看全文</a>')!!}


                </div>
                    @endforeach
            </div>
            <!-- /.tab-pane -->
            <div class="tab-pane" id="tab_2">
                @foreach($fusers as $fuser)
                <div class="blog-post" style="margin-top: 30px">
                    <p class="">{{$fuser->name}}</p>
                    <p class="">关注：{{$fuser->fans_count}} | 粉丝：{{$fuser->stars_count}}｜ 文章：{{$fuser->posts_count}}</p>

                    @include('user/but/button',['target_user'=>$fuser])
                    {{--<div>--}}
                        {{--<button class="btn btn-default like-button" like-value="1" like-user="6" _token="MESUY3topeHgvFqsy9EcM916UWQq6khiGHM91wHy" type="button">取消关注</button>--}}
                    {{--</div>--}}

                </div>
                @endforeach
            </div>
            <!-- /.tab-pane -->
            <div class="tab-pane" id="tab_3">
                @foreach($susers as $suser)
                <div class="blog-post" style="margin-top: 30px">
                    <p class="">{{$suser->name}}</p>
                    <p class="">关注：{{$suser->fans_count}}| 粉丝：{{$suser->stars_count}}｜ 文章：{{$suser->posts_count}}</p>

                   @include('user/but/button',['target_user'=>$suser])

                </div>
                @endforeach
            </div>
            <!-- /.tab-pane -->
        </div>
        <!-- /.tab-content -->
    </div>


</div><!-- /.blog-main -->
@endsection
