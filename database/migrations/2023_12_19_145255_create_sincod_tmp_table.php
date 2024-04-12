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
        Schema::create('sincodTmp', function (Blueprint $table) {
            $table->id();
            $table->string('id_dispo')->nullable();
            $table->string('dispositivo')->nullable();
            $table->string('marca')->nullable();
            $table->string('referencia')->nullable();
            $table->string('serial')->nullable();
            $table->string('procesador')->nullable();
            $table->string('ram')->nullable();
            $table->string('disco_duro')->nullable();
            $table->string('tarjeta_grafica')->nullable();
            $table->string('documento')->nullable();
            $table->string('nombres_apellidos')->nullable();
            $table->string('fecha_compra')->nullable();
            $table->string('garantia')->nullable();
            $table->string('numero_factura')->nullable();
            $table->string('proveedor')->nullable();
            $table->string('estado')->nullable();
            $table->string('observacion')->nullable();
            $table->string('cantidad')->nullable();

            $table->timestamps();

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sincodTmp');
    }
};
