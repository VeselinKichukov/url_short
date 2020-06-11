<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UrlShort extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('url_short', function (Blueprint $table){
           $table->increments('id');
           $table->string('url');
           $table->string('short');
           $table->string('description')->nullable();
           $table->integer('count')->default(0);
           $table->boolean('private');
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
        Schema::dropIfExists('url_short');
    }
}
