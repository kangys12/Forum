@extends('layout.public')
@section('title')文章创建 @endsection
@section('main')
<div class="col-sm-8 blog-main">
    <form class="form-horizontal" action="/user/{{Auth::id()}}/setting" method="POST" enctype="multipart/form-data">
        {{csrf_field()}}
        <div class="form-group">
            <label class="col-sm-2 control-label">用户名</label>
            <div class="col-sm-10">
                <input class="form-control" name="name" type="text" value="{{Auth::user()->name}}">
            </div>
        </div>
        <div class="form-group">
            <label class="col-sm-2 control-label">头像</label>
            <div class="col-sm-2">
                <input class=" file-loading preview_input" type="file" value="用户名" style="width:72px" name="photo">
                @if(Auth::user()->photo=='')
                <img  class="preview_img" src="/image/default.jpg" width="88" alt="" class="img-rounded" style="border-radius:500px;">
                    @else
                    <img  class="preview_img" src="/image/{{Auth::user()->photo}}" alt="" class="img-rounded" style="border-radius:500px;">

                @endif
            </div>
        </div>
        <button type="submit" class="btn btn-default">修改</button>
    </form>
    <br>

</div>
@endsection