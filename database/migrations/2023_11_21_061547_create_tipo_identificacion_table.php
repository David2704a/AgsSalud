<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('tipoIdentificacion', function (Blueprint $table) {
            $table->increments('id');
            $table->string('Detalle');
            $table->timestamps();
        });

        DB::table('tipoIdentificacion')->insert([
            ['Detalle' => 'Cedula Ciudadania'],


        ]);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tipo_identificacion');
    }
};
