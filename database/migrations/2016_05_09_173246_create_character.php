<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCharacter extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('character', function (Blueprint $table) {
            $table->increments('charid');
            $table->string('charclass');
            $table->string('charname');
            $table->string('charbio');
            $table->date('charbirthdate');
            $table->binary('charportrait');
            $table->string('charstylecombat');
            $table->integer('faction_id')->index();
            $table->binary('charfacechar'); 
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
        Schema::drop('character');
    }
}
