<div class="container">
    <ul class="nav navbar-nav navbar-left">
        <li>
            <a class="blog-nav-item " href="/posts">首页</a>
        </li>
        <li>
            <a class="blog-nav-item" href="/posts/create">写文章</a>
        </li>
        <li>
            <a class="blog-nav-item" href="/notices">通知</a>
        </li>
        <li>
            <input name="query" type="text" value="" class="form-control" style="margin-top:10px" placeholder="搜索词">
        </li>
        <li>
            <button class="btn btn-default" style="margin-top:10px" type="submit">Go!</button>
        </li>
    </ul>

    <ul class="nav navbar-nav navbar-right">
        <li class="dropdown">
            @if(Auth::check())
            <div>
                @if(Auth::user()->photo=='')
                    <img src="/image/default.jpg" alt="" class="img-rounded" style="border-radius:500px; height: 30px">

                    {{--<img  class="preview_img" src="/image/default.jpg" width="88" alt="" class="img-rounded" style="border-radius:500px;">--}}
                @else
                    <img src="/image/{{Auth::user()->photo}}" alt="" class="img-rounded" style="border-radius:500px; height: 30px">

                    {{--<img  class="preview_img" src="/image/{{Auth::user()->photo}}" alt="" class="img-rounded" style="border-radius:500px;">--}}

                @endif
                <a href="#" class="blog-nav-item dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">{{Auth::user()->name}}  <span class="caret"></span></a>
                <ul class="dropdown-menu">
                    <li><a href="/user/{{Auth::id()}}">我的主页</a></li>
                    <li><a href="/user/{{Auth::id()}}/setting">个人设置</a></li>
                    <li><a href="/logout">登出</a></li>
                </ul>
            </div>
                @else
                <div>
                    <img src="/image/default.jpg" alt="" class="img-rounded" style="border-radius:500px; height: 30px">
                    <a href="#" class="blog-nav-item dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
                          <span class="caret"></span>
                    </a>
                    <ul class="dropdown-menu">
                        <li><a href="/register">注册</a></li>
                        <li><a href="/login">登录</a></li>

                    </ul>
                </div>
            @endif
        </li>
    </ul>
</div>