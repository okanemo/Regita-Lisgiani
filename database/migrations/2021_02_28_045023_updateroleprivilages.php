<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Updateroleprivilages extends Migration
{
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		DB::unprepared("
			DELETE FROM `role_privileges` WHERE `role_privileges`.`id` = 2;
			DELETE FROM `role_privileges` WHERE `role_privileges`.`id` = 3;
			DELETE FROM `role_privileges` WHERE `role_privileges`.`id` = 4;
			DELETE FROM `role_privileges` WHERE `role_privileges`.`id` = 5;
			DELETE FROM `role_privileges` WHERE `role_privileges`.`id` = 6;
			DELETE FROM `role_privileges` WHERE `role_privileges`.`id` = 7;
			DELETE FROM `role_privileges` WHERE `role_privileges`.`id` = 8;
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
