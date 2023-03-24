<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateGruposTable extends Migration
{
  /**
   * Run the migrations.
   *
   * @return void
   */
  public function up()
  {
    Schema::create('grupos', function (Blueprint $table) {
      $table->increments('id');
      $table->integer('id_subfamilia');
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
    Schema::dropIfExists('grupos');
  }
}
