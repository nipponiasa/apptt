<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class SalesUnitTarget extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        
        
        
        Schema::create('sales_unit_target', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->integer('month');
            $table->integer('year');
            $table->integer('total_units_month')->nullable();
            $table->integer('group_id')->nullable();
            $table->string('group_name')->nullable();

        }); 
        
        
        
        
        
        
        
        
        
        
        //
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('sales_unit_target');
    }
}
