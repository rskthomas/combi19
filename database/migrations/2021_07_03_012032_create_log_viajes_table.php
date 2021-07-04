<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLogViajesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('log_viajes', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->string('nombre');
            $table->string('descripcion');
            $table->date('fecha_salida');
            $table->time('hora_salida');
            $table->string('estado');
            $table->double('precio');
            $table->integer('pasajes_vendidos');
            $table->string('nombre_chofer');
            $table->string('mail_chofer');
            $table->integer('id_chofer')->nullable();
            $table->string('salida');
            $table->string('llegada');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('log_viajes');
    }
}
