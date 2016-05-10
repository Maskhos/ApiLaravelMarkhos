<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->increments('usid');
            $table->string('usname');
            $table->binary('uspicture');
            $table->date('usbirthDate');
            $table->string('country');
            $table->boolean('usadmin');
            $table->boolean('userased');
            $table->string('ustwitter');
            $table->string('usfacebook');
            $table->string('usinstagram');
            $table->integer('faction_id')->index();
            $table->string('ustumblr');
            $table->string('usdesc');
            $table->string('usemail')->unique();
            $table->string('uspassword');
            $table->rememberToken();
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
        Schema::drop('users');
    }
}
