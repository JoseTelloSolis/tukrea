<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateNosotrosTable extends Migration
{
  /**
   * Run the migrations.
   *
   * @return void
   */
  public function up()
  {
    Schema::create('nosotros', function (Blueprint $table) {
      $table->increments('id');
      $table->text('imagen');
      $table->text('titulo');
      $table->longText('texto');
      $table->timestamps();
    });

    DB::table('nosotros')->insert(
      array(
        'imagen' => '',
        'titulo' => '',
        'texto' => ''
      )
    );

  }

  /**
   * Reverse the migrations.
   *
   * @return void
   */
  public function down()
  {
    Schema::dropIfExists('nosotros');
  }
}
