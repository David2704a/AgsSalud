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
        Schema::create('elemento', function (Blueprint $table) {
            $table->bigIncrements('idElemento');
            $table->string('marca');
            $table->string('referencia');
            $table->string('serial');
            $table->longText('especificaciones');

            $table->string('modelo');
            $table->string('garantia');
            $table->integer('valor');
            $table->text('descripcion');

            $table->unsignedBigInteger('idEstadoEquipo');
            $table->foreign('idEstadoEquipo')->references('idEstadoE')->on('estadoelemento');

            $table->unsignedBigInteger('idTipoElemento');
            $table->foreign('idTipoElemento')->references('idTipoElemento')->on('tipoelemento');

            $table->unsignedBigInteger('idCategoria');
            $table->foreign('idCategoria')->references('idCategoria')->on('categoria');

            $table->unsignedBigInteger('idFactura')->nullable();
            $table->foreign('idFactura')->references('idFactura')->on('factura');

            $table->unsignedBigInteger('idUsuario');
            $table->foreign('idUsuario')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('elemento');
    }
};
