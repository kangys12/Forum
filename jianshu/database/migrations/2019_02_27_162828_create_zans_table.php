<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateZansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {

        Schema::create('zan', function (Blueprint $table) {
            $table->increments('id')->comment('主键');
            $table->integer('post_id')->defaule(0)->comment('帖子id外键');
            $table->integer('user_id')->defaule(0)->comment('用户id外键');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('zans');
    }
}
