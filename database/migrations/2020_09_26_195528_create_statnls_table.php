<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStatnlsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('statnls', function (Blueprint $table) {
            $table->id()->autoIncrement();
            $table->timestamps();
            $table->string('brand', 100);
            $table->string('motocategory', 40);
           $table->smallInteger('month')->unsigned();
            $table->smallInteger('year')->unsigned();
           $table->integer('unitssold')->unsigned();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('statnls');
    }
}
