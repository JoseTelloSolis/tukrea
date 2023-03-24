<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePedidosTable extends Migration
{
  /**
   * Run the migrations.
   *
   * @return void
   */
  public function up()
  {
    Schema::create('pedidos', function (Blueprint $table) {
      $table->increments('id');
      $table->text('tipo');
      $table->text('ruc');
      $table->text('razon_social');
      $table->text('nombre');
      $table->text('apellidos');
      $table->text('dni');
      $table->text('email');
      $table->text('telefono');
      $table->text('celular');
      $table->text('ciudad');
      $table->text('distrito');
      $table->text('direccion');
      $table->decimal('total', 8, 2);
      $table->text('estado');
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
    Schema::dropIfExists('pedidos');
  }
}
