<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSaleTargetTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sale_target', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->integer('month');
            $table->integer('year');
            $table->unsignedBigInteger('sale_units')->nullable();
            $table->double('sale_euro', 12, 2)->nullable();


        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('sale_target');
    }
}
