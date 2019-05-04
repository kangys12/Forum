@extends('layout.public')
@section('title')文章创建 @endsection

@section('main')
<div class="col-sm-8 blog-main">
    @if (count($errors) > 0)
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    <form action="/posts" method="POST">

        {{csrf_field()}}
        {{--<input type="hidden" name="_token" value="MESUY3topeHgvFqsy9EcM916UWQq6khiGHM91wHy">--}}
        <div class="form-group">
            <label>标题</label>
            <input name="title" type="text" class="form-control" placeholder="这里是标题">
        </div>
        <div class="form-group">
            <label>内容</label>
            <textarea id="content"  style="height:400px;max-height:500px;" name="content" class="form-control" placeholder="这里是内容"></textarea>
        </div>
        <button type="submit" class="btn btn-default">提交</button>
    </form>
    <br>

</div><!-- /.blog-main -->
@endsection