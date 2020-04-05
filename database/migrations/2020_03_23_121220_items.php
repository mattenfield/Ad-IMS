<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Items extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('items', function (Blueprint $table) {
            $table->bigIncrements('id');
        });
        Schema::table('items', function (Blueprint $table) {
            $table->string('itemDescription');
            $table->dateTime('itemLastScanned')->nullable(true);
            $table->string('itemScannedBy');
            $table->char('photoUploadLink', 100)->nullable(true);
            $table->unsignedBigInteger('inventoryID');
            $table->foreign('inventoryID')->references('id')->on('inventories');
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
