<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class SalesUnitTargetRenameToCategAddSalePrice extends Migration
{
    public function up()
    {
        Schema::table('sales_unit_target', function(Blueprint $table) {
            $table->renameColumn('group_id', 'categ_id');
            $table->double('wholesale_price');
        });
    }


    public function down()
    {
        Schema::table('sales_unit_target', function(Blueprint $table) {
            $table->renameColumn('categ_id', 'group_id');
            $table->dropColumn('wholesale_price');
        });
    }
}
