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
        Schema::create('procedimiento', function (Blueprint $table) {
            $table->bigIncrements('idProcedimiento');
            $table->date('fechaInicio')->nullable();
            $table->date('fechaFin')->nullable();
            $table->time('hora')->nullable();
            $table->date('fechaReprogramada')->nullable();
            $table->text('observacion');

            $table->unsignedBigInteger('idResponsableEntrega')->nullable();
            $table->foreign('idResponsableEntrega')->references('id')->on('users');

            $table->unsignedBigInteger('idResponsableRecibe')->nullable();
            $table->foreign('idResponsableRecibe')->references('id')->on('users');

            $table->unsignedBigInteger('idElemento');
            $table->foreign('idElemento')->references('idElemento')->on('elemento');

            $table->unsignedBigInteger('idEstadoProcedimiento');
            $table->foreign('idEstadoProcedimiento')->references('idEstadoP')->on('estadoProcedimiento');

            $table->unsignedBigInteger('idTipoProcedimiento');
            $table->foreign('idTipoProcedimiento')->references('idTipoProcedimiento')->on('tipoProcedimiento'); // Corregido el nombre de la tabla relacionada
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('procedimiento');
    }
};
