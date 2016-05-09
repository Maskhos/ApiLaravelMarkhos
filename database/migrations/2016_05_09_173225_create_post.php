<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePost extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('post', function (Blueprint $table) {
            $table->increments('posid');
            $table->integer('user_id')->index();
            $table->string('postitle');
            $table->string('posdescription');
            $table->string('poscontent');
            $table->binary('posphoto');
            $table->date('posdate');
            $table->string('shortdesc');
            $table->integer('category_id')->index();
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
        Schema::drop('post');
    }
}
