<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateClientesTable extends Migration
{
    
  public function up()
  {
    Schema::create('clientes', function (Blueprint $table) {
      $table->increments('id');
      $table->boolean('activo');
      $table->string('email');
      $table->string('password');
      $table->string('ruc');
      $table->string('razon_social');
      $table->string('nombre');
      $table->string('apellidos');
      $table->string('dni');
      $table->string('telefono');
      $table->string('celular');
      $table->string('ciudad');
      $table->string('distrito');
      $table->string('direccion');
      $table->rememberToken();
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
    Schema::dropIfExists('clientes');
  }
}
