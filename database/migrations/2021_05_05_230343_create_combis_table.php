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
            $table->String('patente');
            $table->integer('asientos');
            $table->boolean('isComoda');
            $table->integer('modelo');

            $table->foreignId('chofer_id')
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
        Schema::dropIfExists('combis');
    }
}
