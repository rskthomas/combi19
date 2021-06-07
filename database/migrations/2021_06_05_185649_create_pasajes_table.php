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
            $table->json("productos");
            $table->double("total_pasaje");
            $table->double("total_productos");
            $table->foreignId('viaje_id')
            ->nullable()
            ->onDelete('SET NULL')
            ->constrained('viajes');
            $table->foreignId('user_id')
            ->nullable()
            ->onDelete('SET NULL')
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
