<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAddedStockTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('added_stock', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->unsignedBigInteger('product_id');
            $table->longText('product_name')->nullable();
            $table->unsignedBigInteger('cat_id');
            $table->longText('cat_name')->nullable();
            $table->integer('qty');
            $table->longText('location')->nullable();
            $table->timestamp('added_on')->nullable();
            $table->timestamp('eta')->nullable();

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('added_stock');
    }
}
