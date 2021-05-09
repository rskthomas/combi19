<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRutasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('rutas', function (Blueprint $table) {
            $table->id();
            $table->string("tiempo");
            $table->string("kms");
            $table->foreignId('lugar_salida')
            ->nullable()
            ->onDelete('set null')
            ->constrained('lugars');
            $table->foreignId('lugar_llegada')
            ->nullable()
            ->onDelete('set null')
            ->constrained('lugars');
            
            
            $table->foreignId('combi_id')
            ->nullable()
            ->onDelete('set null')
            ->constrained('combis');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('rutas');
    }
}
