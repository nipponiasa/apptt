<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePickDelsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pick_dels', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->string('pickingtype')->nullable();
            $table->string('operationtype')->nullable();
            $table->string('vin')->nullable();
            $table->longText('model')->nullable();
            $table->longText('modeldet')->nullable();
            $table->string('licencenbr')->nullable();
            $table->longText('dealer')->nullable();
            $table->longText('dealerloc')->nullable();
            $table->longText('address')->nullable();
            $table->string('dealeremail')->nullable();
            $table->string('phone')->nullable();
            $table->string('maila')->nullable();
            $table->boolean('vehicleworks')->nullable();
            $table->boolean('keyspresent')->nullable();
            $table->boolean('remotepresent')->nullable();
            $table->boolean('toolkitpresent')->nullable();
            $table->boolean('vinplatematch')->nullable();
            $table->boolean('casespresent')->nullable();
            $table->boolean('mirrorspresent')->nullable();
            $table->boolean('batterypresent')->nullable();
            $table->boolean('chargerpresent')->nullable();
            $table->boolean('chargertested')->nullable();
            $table->boolean('damage')->nullable();
            $table->string('batterynbr')->nullable();
            $table->string('batterytype')->nullable();
            $table->string('chargernbr')->nullable();
            $table->longText('comments')->nullable();
            $table->string('created_by')->nullable();
            $table->boolean('isfinalized')->nullable();
            $table->string('routingnbr')->nullable();
            $table->date('routingdate')->nullable();
            $table->longText('imagesignurl')->nullable();
            $table->longText('imageurl')->nullable();





        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('pick_dels');
    }
}
