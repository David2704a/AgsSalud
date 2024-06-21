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
        Schema::create('ingreso_y_o_salida', function (Blueprint $table) {
            $table->increments('id_ingreso');
            $table->string('motivo_ingreso');
            $table->string('descripcion_equipo_ingreso');
            $table->string('descripcion_equipo_ingreso_2')->nullable();
            $table->string('descripcion_equipo_ingreso_3')->nullable();
            $table->string('descripcion_equipo_ingreso_4')->nullable();
            $table->string('descripcion_equipo_ingreso_5')->nullable();
            $table->date('fecha_in_salida');
            $table->date('fecha_fin_salida')->nullable();
            $table->time('hora_in_salida');
            $table->set('prestamo', ['SI', 'NO']);
            $table->unsignedBigInteger('id_userAutorizado');
            $table->foreign('id_userAutorizado')->references('id')->on('users');
            $table->unsignedBigInteger('id_userAutoriza');
            $table->foreign('id_userAutoriza')->references('id')->on('users');
            $table->unsignedBigInteger('id_elemento');
            $table->foreign('id_elemento')->references('idElemento')->on('elemento');
            $table->unsignedBigInteger('id_elemento_2')->nullable();
            $table->foreign('id_elemento_2')->references('idElemento')->on('elemento')->nullable();
            $table->unsignedBigInteger('id_elemento_3')->nullable();
            $table->foreign('id_elemento_3')->references('idElemento')->on('elemento')->nullable();
            $table->unsignedBigInteger('id_elemento_4')->nullable();
            $table->foreign('id_elemento_4')->references('idElemento')->on('elemento')->nullable();
            $table->unsignedBigInteger('id_elemento_5')->nullable();
            $table->foreign('id_elemento_5')->references('idElemento')->on('elemento')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ingreso_y_o_salida');
    }
};
