<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->rememberToken();
            $table->timestamps();
            /* solo del usuario viajero*/
            $table->boolean('isGold')-> nullable();
            /* solo del usuario chofer*/
            $table->integer('cellphone') -> nullable();
            $table->date('birthdate');

            $table->foreignId('combi_id')
            ->nullable()
            ->onDelete('SET NULL')
            ->constrained('combis');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('lugars');
        Schema::dropIfExists('users');
        Schema::dropIfExists('combis');
    }
}
