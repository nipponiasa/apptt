<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMolEditsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('mol_edits', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->unsignedBigInteger('user_id');
            $table->foreign('user_id')->references('id')->on('users');
            $table->longText('user_explain')->default(Null);
            $table->longText('system_explain')->default(Null);
            $table->unsignedBigInteger('mol_tranfer_id');
            $table->foreign('mol_tranfer_id')->references('id')->on('moltranfers');
           // $table->enum('status',  ['Delivered','Invoiced','Canceled', 'Returned', 'Unknown'])->default('Delivered');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('mol_edits');
    }
}
