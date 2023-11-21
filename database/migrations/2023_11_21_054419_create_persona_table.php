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
        Schema::create('persona', function (Blueprint $table) {
            $table->increments('id');
            $table->string('nombre1')->nullable();
            $table->string('nombre2')->nullable();
            $table->string('apellido1')->nullable();
            $table->string('apellido2')->nullable();
            $table->unsignedInteger('idTipoIdentificacion')->nullable();
            $table->string('identificacion')->unique()->nullable();
            $table->date('fechaNac')->nullable();
            $table->char('sexo', 1)->nullable();
            $table->string('direccion')->nullable();
            $table->string('email')->nullable();
            $table->string('celular')->nullable();

            $table->timestamps();
            
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('persona');
    }
};
