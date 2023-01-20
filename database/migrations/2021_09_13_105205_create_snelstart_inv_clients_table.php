<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSnelstartInvClientsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('snelstart_inv_clients', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->string('dealer');
            $table->integer('dealerid');
            $table->string('invoicenbr');
            $table->date('invoicedate');
           $table->double('invoicevalue');
        




        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('snelstart_inv_clients');
    }
}
