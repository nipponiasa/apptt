<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class GroupProdBind extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('group_prod_bind', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->integer('group_id');
            $table->integer('odoo_id')->nullable();
            $table->string('odoo_name')->nullable();

        }); 
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('group_prod_bind');
    }
}
