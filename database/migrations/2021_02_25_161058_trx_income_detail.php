<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class TrxIncomeDetail extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('trx_income_details', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('trx_income_id');
            $table->integer('sub_category_id');
            $table->string('remarks');
            $table->dateTime('entry_date')->nullable();
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
    Schema::dropIfExists('trx_income_details');
}
}