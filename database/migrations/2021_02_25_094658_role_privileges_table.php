<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class RolePrivilegesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('role_privileges', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('role_id');
            $table->integer('menu_id');
            $table->enum('view',[0,1])->default(0)->comment('0=false | 1 true');
            $table->enum('create',[0,1])->default(0)->comment('0=false | 1 true');
            $table->enum('edit',[0,1])->default(0)->comment('0=false | 1 true');
            $table->enum('delete',[0,1])->default(0)->comment('0=false | 1 true');
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
        Schema::dropIfExists('role_privileges');
    }
}
