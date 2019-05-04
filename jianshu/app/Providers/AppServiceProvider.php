<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Schema;
class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
        Schema::defaultStringLength(250);
        //使用视图合成器向公共模板文件分配数据
        \View::composer('layout.sidebar', function($view){
            //获取所有的专题信息
            $topics = \App\Topic::all();
            //通过视图对象将信息分配到视图
            $view->with('topics', $topics);
	    });

    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
