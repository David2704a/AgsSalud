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
        Schema::create('elementonoid', function (Blueprint $table) {
            $table->id();
            
            $table->string('cantidad')->nullable();


            $table->unsignedBigInteger('idCategoria')->nullable(); // enn el excel esta e la columnna dispositivo 
            $table->foreign('idCategoria')->references('idCategoria')->on('categoria');// enn el excel esta e la columnna dispositivo 

            $table->string('marca')->nullable();
            $table->string('referencia')->nullable();


            $table->string('observacion')->nullable();
 
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('elementonoid');
    }
};
