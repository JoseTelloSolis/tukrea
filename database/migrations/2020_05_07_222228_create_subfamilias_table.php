<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSubfamiliasTable extends Migration
{
  /**
   * Run the migrations.
   *
   * @return void
   */
  public function up()
  {
    Schema::create('subfamilias', function (Blueprint $table) {
      $table->increments('id');
      $table->integer('id_categoria');
      $table->text('codigo');
      $table->boolean('activo');
      $table->text('nombre');
      $table->text('url');
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
    Schema::dropIfExists('subfamilias');
  }
}
