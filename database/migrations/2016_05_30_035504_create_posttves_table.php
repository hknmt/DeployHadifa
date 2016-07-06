<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePosttvesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('posttves', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('tves_id')->unsigned();
            $table->string('information');
            $table->string('content');
            $table->integer('view')->default(0);
            $table->timestamps();

            $table->foreign('tves_id')->references('id')->on('tves');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('posttves');
    }
}
