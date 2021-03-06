<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePasajesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pasajes', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->integer("asiento");
            $table->string("estado");
            $table->string('nombre')->nullable();
            $table->string('descripcion')->nullable();
            $table->date('fecha_salida');
            $table->time('hora_salida');
            $table->string('salida');
            $table->string('llegada');
            $table->json("productos");
            $table->double("total_compra");
            $table->double("total_productos");
            $table->double("total_descuentos");
            $table->double("total_pasaje");
            $table->double("dinero_devuelto")->nullable();
            $table->foreignId('viaje_id')
            ->unsigned()
            ->nullable()
            ->onDelete('set null')
            ->constrained('viajes');
            $table->foreignId('user_id')
            ->nullable()
            ->onDelete('set null')
            ->constrained('users');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('pasajes');
    }
}
