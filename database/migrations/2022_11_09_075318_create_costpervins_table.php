<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCostpervinsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('costpervins', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->longText('product_name')->nullable();
            $table->unsignedBigInteger('cat_id')->nullable();
            $table->string('po')->nullable();
            $table->double('cost')->nullable();
            $table->boolean('in_stock')->nullable();
            $table->longText('cat_name')->nullable();
            $table->string('VIN')->nullable();

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('costpervins');
    }
}
