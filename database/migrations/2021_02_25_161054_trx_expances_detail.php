<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class TrxExpancesDetail extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('trx_expance_details', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('trx_expance_id');
            $table->integer('sub_category_id');
            $table->string('remarks');
            $table->dateTime('spent_at')->nullable();
            $table->decimal('total',12,2);
            $table->dateTime('deleted_at')->nullable();
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
        Schema::dropIfExists('trx_expance_details');
    }
}
