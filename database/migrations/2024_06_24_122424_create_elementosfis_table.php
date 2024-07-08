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
        Schema::create('elementosfis', function (Blueprint $table) {
            $table->id();
            $table->string('id_dispo')->unique(); // excel columna A
            $table->unsignedBigInteger('idCategoria')->nullable();
            $table->foreign('idCategoria')->references('idCategoria')->on('categoria');// excel columna B
            $table->string('marca')->nullable();// excel columna C
            $table->unsignedBigInteger('idUser')->nullable();
            $table->foreign('idUser')->references('id')->on('users');// excel columna D
            $table->string('estado_oficina')->nullable(); // excel columna F
            $table->unsignedBigInteger('idEstado')->nullable();
            $table->foreign('idEstado')->references('idEstadoE')->on('estadoElemento');// excel columna g
            $table->string('observacion')->nullable();// excel columna H
            $table->string('sede')->nullable();// excel columna I
            $table->string('ubicacion_interna')->nullable();// excel columna J 
            $table->string('ubicacion_especifica')->nullable();// excel columna K
            $table->longText('codigo')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('elementosfis');
    }
};
