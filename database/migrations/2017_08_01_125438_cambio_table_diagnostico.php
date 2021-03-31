<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CambioTableDiagnostico extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('diagnostico', function($table){

             $table->timestamp('created_at')->useCurrent()->change();
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
