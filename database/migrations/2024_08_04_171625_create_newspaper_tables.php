<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('roles', function (Blueprint $table) {
            $table->id();
            $table->string('rol', length: 100)->unique();
        });

        Schema::create('usuarios', function (Blueprint $table) {
            $table->id();
            $table->string('usuario', length: 100)->unique();
            $table->string('password', length: 100);
            $table->string('nombre', length: 100);
            $table->string('apellidos', length: 100);
            $table->string('correo', length: 100)->unique();
            $table->unsignedBigInteger('rol');
            $table->boolean('activo');
            $table->rememberToken();

            $table->foreign('rol')->references('id')->on('roles');
        });

        Schema::create('categorias', function (Blueprint $table) {
            $table->id();
            $table->string('categoria', length: 100)->unique();
        });

        Schema::create('noticias', function (Blueprint $table) {
            $table->id();
            $table->string('titular', length: 150);
            $table->unsignedBigInteger('categoria');
            $table->string('ano', length: 4);
            $table->string('mes', length: 2);
            $table->unsignedBigInteger('escritor');
            $table->string('slug', length: 155)->unique();
            $table->string('multimedia', length: 200)->unique();
            $table->foreign('categoria')->references('id')->on('categorias');
            $table->foreign('escritor')->references('id')->on('usuarios');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('roles');
        Schema::dropIfExists('usuarios');
        Schema::dropIfExists('categorias');
        Schema::dropIfExists('noticias');
    }
};
