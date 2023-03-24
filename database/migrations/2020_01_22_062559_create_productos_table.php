<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProductosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('productos', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('id_grupo');
            $table->boolean('activo');
            $table->text('url');
            $table->text('idcodi');
            $table->text('codigo');
            $table->text('nombre');
            $table->integer('stock');
            $table->text('imagen');
            $table->text('resumen');
            $table->longText('descripcion');
            $table->longText('adicional');
            $table->decimal('precio', 8, 2);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('productos');
    }
}
