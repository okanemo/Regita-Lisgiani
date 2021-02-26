<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Updatesomemenu extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::unprepared("
            DELETE FROM `menu` WHERE `menu`.`menu_id` = 9;
            UPDATE `menu` SET `menu_name` = 'Report' WHERE `menu`.`menu_id` = 8;
            UPDATE `menu` SET `menu_url` = 'report' WHERE `menu`.`menu_id` = 8;
		");
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
