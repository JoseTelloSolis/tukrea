<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePoliticasTable extends Migration
{
  /**
   * Run the migrations.
   *
   * @return void
   */
  public function up()
  {
    Schema::create('politicas', function (Blueprint $table) {
      $table->increments('id');
      $table->longText('texto');
      $table->timestamps();
    });

    DB::table('politicas')->insert(
      array(
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
    Schema::dropIfExists('politicas');
  }
}