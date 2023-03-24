<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCategoriasTable extends Migration
{
  /**
   * Run the migrations.
   *
   * @return void
   */
  public function up()
  {
    Schema::create('categorias', function (Blueprint $table) {
      $table->increments('id');
      $table->text('codigo');
      $table->boolean('activo');
      $table->text('nombre');
      $table->text('url');
      $table->text('imagen');
      $table->text('banner');
      $table->text('resumen');
      $table->text('descripcion');
      $table->timestamps();
    });

    /*DB::table('categorias')->insert([
      ['categoria' => 'escolar', 'url' => 'escolar.html'],
      ['categoria' => 'oficina', 'url' => 'oficina.html'],
      ['categoria' => 'cómputo', 'url' => 'computo.html'],
      ['categoria' => 'papelería', 'url' => 'papeleria.html']
    ]);*/
  }

  /**
   * Reverse the migrations.
   *
   * @return void
   */
  public function down()
  {
    Schema::dropIfExists('categorias');
  }
}
