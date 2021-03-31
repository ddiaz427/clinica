<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CambioTipoCampoBarrios extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('barrio', function($table){
			 //$table->increments('id');
			 $table->integer('creadopor')->unsigned()->index()->change();	
			 $table->integer('modificadopor')->unsigned()->index()->nullable()->change();	

		});
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
