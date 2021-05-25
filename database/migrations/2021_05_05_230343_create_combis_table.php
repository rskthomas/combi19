<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCombisTable extends Migration
{

    /**
     * Run the migrations.
     *
     * @return void
     */

    public function up()
    {
        Schema::create('combis', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->String('patente')
                -> unique();
            $table->integer('asientos');
            $table->string('tipo_de_combi');
            $table->integer('modelo');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
      //  Schema::dropIfExists('combis');
    }
}
