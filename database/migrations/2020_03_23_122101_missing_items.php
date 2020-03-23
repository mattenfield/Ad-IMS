<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class MissingItems extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('MissingItems', function (Blueprint $table) {
            $table->bigIncrements('id');
        });
        Schema::table('MissingItems', function (Blueprint $table) {
            $table->unsignedBigInteger('itemID');
            $table->foreign('itemID')->references('id')->on('items');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
