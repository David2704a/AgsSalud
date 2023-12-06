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
        Schema::create('factura', function (Blueprint $table) {
            $table->bigIncrements('idFactura');
            $table->integer('codigoFactura');
            $table->date('fechaCompra');

            $table->unsignedBigInteger('idProveedor');
            $table->foreign('idProveedor')->references('idProveedor')->on('proveedor');

            $table->string('metodoPago')->nullable();
            $table->string('rutaFactura')->nullable();
            $table->integer('valor') ->nullable();
            $table->text('descripcion') ->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('factura');
    }
};
