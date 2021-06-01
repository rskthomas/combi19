<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTarjetasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tarjetas', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->integer('number');
            $table->string('name');
            $table->integer('cvc');
            $table->integer('expiration_year');
            $table->integer('expiration_month');

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
        Schema::dropIfExists('tarjetas');
    }
}
