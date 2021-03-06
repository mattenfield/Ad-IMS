<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Adddefaultinventory extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::table('inventories')->insert(
            array(
                'inventoryName' => 'Technical Equipment'
            )
        );
        DB::table('inventories')->insert(
            array(
                'inventoryName' => 'Costumes'
            )
        );
        DB::table('inventories')->insert(
            array(
                'inventoryName' => 'Tools'
            )
        );
        DB::table('inventories')->insert(
            array(
                'inventoryName' => 'Miscellaneous'
            )
        );
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
