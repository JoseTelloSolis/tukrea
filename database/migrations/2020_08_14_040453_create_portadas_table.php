<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePortadasTable extends Migration
{
  /**
   * Run the migrations.
   *
   * @return void
   */
  public function up()
  {
    Schema::create('portadas', function (Blueprint $table) {
      $table->increments('id');
      $table->text('imagen');
      $table->text('titulo1');
      $table->text('texto1');
      $table->text('titulo2');
      $table->text('texto2');
      $table->text('titulo2b');
      $table->text('texto2b');
      $table->text('titulo3');
      $table->text('texto3');
      $table->text('titulo4');
      $table->text('texto4');
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
    Schema::dropIfExists('portadas');
  }
}
