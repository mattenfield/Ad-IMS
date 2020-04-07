<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Requests extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
        public function up()
        {
            Schema::create('Requests', function (Blueprint $table) {
                $table->bigIncrements('id');
            });
            Schema::table('Requests', function (Blueprint $table) {
                $table->string('itemDescription');
                $table->char('photoUploadLink', 100)->nullable(true);
                $table->unsignedBigInteger('inventoryID')->nullable(true);
                $table->foreign('inventoryID')->references('id')->on('inventories');
                $table->char('photoEvidenceUploadLink', 100);
                $table->boolean('uploaded');
                $table->boolean('approved')->nullable(true);
                $table->dateTime('updated_at');
                $table->dateTime('created_at');
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
