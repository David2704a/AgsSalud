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
            $table->string('id_dispo')->nullable(); //hace rferencia a id del excel

            $table->string('marca')->nullable(); // hace referencia a la columna marca de excel

            $table->string('referencia')->nullable();// hace referencia a la columna referecia del excel
            $table->string('serial')->nullable();// hace referencia a la columna serial del excel
            
            $table->string('procesador')->nullable();// hace referencia a la columna procesador del excel
            $table->string('ram')->nullable();// hace referencia a la columna ram del excel
            $table->string('disco_duro')->nullable();// hace referencia a la columna disco duro del excel
            $table->string('tarjeta_grafica')->nullable(); // hace referencia a la columna tarjeta grafica del excel

            

            $table->string('modelo')->nullable(); //este se deja en blanco
            $table->string('garantia')->nullable(); //hace referencia a mi columna garantia de mi excel a cargar
            $table->integer('valor')->nullable(); //este se deja vacio
            $table->text('descripcion')->nullable(); //hace referencia a la columna observacion de i excel que quiero cargar

            $table->unsignedBigInteger('idEstadoEquipo')->nullable(); //este atributo se conecta con la tabla estado la cual contiene una descripcion que quiero poder llenar con mi carga del excel con la columna estado
            $table->foreign('idEstadoEquipo')->references('idEstadoE')->on('estadoelemento');

            $table->unsignedBigInteger('idTipoElemento')->nullable(); //este quiero dejarlo nulo 
            $table->foreign('idTipoElemento')->references('idTipoElemento')->on('tipoelemento');



            $table->unsignedBigInteger('idCategoria'); // enn el excel esta e la columnna dispositivo 
            $table->foreign('idCategoria')->references('idCategoria')->on('categoria');// enn el excel esta e la columnna dispositivo 



            $table->unsignedBigInteger('idFactura')->nullable(); //conecta con la tabla factura la cual contiene de atributos fecha de co,mpra que corresponderia a la columna fecha de compra del excel y el atributo codigo factura el cual tedria que llenarse con la coluna numero de factura de mi excel ademas de ello esa tabla contiene un idproveedor perteneciente a la tabla proveedor que contiene un atributo llamado nombre el cual necesito llenar con mi colummna proveedor del excel 
            $table->foreign('idFactura')->references('idFactura')->on('factura');

            $table->unsignedBigInteger('idUsuario')->nullable(); //connecta con una tabla que see llamma user que contiene un id persona la cual coonecta con la tabla persona que contiene documento que quiero llennar con la columna documento del excel  y necesito llenar al igual que con la columna nombres y apellidos que se deben guardar en la tabla persona pero desglosados en los atributo nombre1, nombre2, apellido1, apellido2  
            $table->foreign('idUsuario')->references('id')->on('users');

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('elemento');
    }
};
