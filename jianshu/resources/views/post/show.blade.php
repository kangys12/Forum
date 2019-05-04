@extends('layout.public')
@section('title')文章详情 @endsection

@section('main')
<div class="col-sm-8 blog-main">
    <div class="blog-post">
        <div style="display:inline-flex">
            <h2 class="blog-post-title">{{$post->title}}</h2>
            @can('update', $post)
            <a style="margin: auto"  href="/posts/{{$post->id}}/edit">
                <span class="glyphicon glyphicon-pencil" aria-hidden="true"></span>
            </a>
            @endcan
            @can('delete', $post)
            <a style="margin: auto"  href="/posts/{{$post->id}}/delete">
                <span class="glyphicon glyphicon-remove" aria-hidden="true"></span>
            </a>
            @endcan
        </div>

        <p class="blog-post-meta">{{$post->created_at->toFormattedDateString()}} by <a href="/user/{{$post->user->id}}">{{$post->user->name}}</a></p>

        {!! $post->content !!}
        <div>
            @if($post->zan(\Auth::id())->exists())
            <a href="/posts/{{$post->id}}/cancel" type="button" class="btn btn-primary btn-lg">取消赞</a>
            @else
                <a href="/posts/{{$post->id}}/zan" type="button" class="btn btn-primary btn-lg">赞</a>
            @endif
        </div>
    </div>

    <div class="panel panel-default">
        <!-- Default panel contents -->
        <div class="panel-heading">评论</div>

        <!-- List group -->
        <ul class="list-group">
            @if($post->comments->isNotempty())
                @foreach($post->comments as $v)
                <li class="list-group-item">
                    <h5>{{$v->created_at}}by{{$v->user->name}}</h5>
                    <div>
                        {{$v->content}}
                    </div>
                </li>
                @endforeach
                @else
                <li class="list-group-item">还没有人评论，快来评论吧！</li>
            @endif
        </ul>
    </div>

    <div class="panel panel-default">
        <!-- Default panel contents -->
        <div class="panel-heading">发表评论</div>

        <!-- List group -->
        <ul class="list-group">
            <form action="/posts/{{$post->id}}/comment" method="post">
                {{--<input type="hidden" name="_token" value="4BfTBDF90Mjp8hdoie6QGDPJF2J5AgmpsC9ddFHD">--}}
                {{csrf_field()}}
                <input type="hidden" name="post_id" value="{{$post->id}}"/>
                <li class="list-group-item">
                    <textarea name="content" class="form-control" rows="10"></textarea>
                    <button class="btn btn-default" type="submit">提交</button>
                </li>
            </form>

        </ul>
    </div>

</div><!-- /.blog-main -->
@endsection