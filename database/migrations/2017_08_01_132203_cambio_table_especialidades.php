<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CambioTableEspecialidades extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('especialidad', function($table){

             $table->datetime('fechacreacion')->default(DB::raw('CURRENT_TIMESTAMP'))->change();
             $table->datetime('fechaultmodificacion')->nullable()->change();
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
