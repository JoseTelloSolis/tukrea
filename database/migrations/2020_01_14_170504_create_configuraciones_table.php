<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateConfiguracionesTable extends Migration
{
  /**
   * Run the migrations.
   *
   * @return void
   */
  public function up()
  {
    Schema::create('configuraciones', function (Blueprint $table) {
      $table->increments('id');
      $table->text('logo');
      $table->text('email');
      $table->longText('nosotros');
      $table->longText('contacto');
      $table->longText('libre');
      $table->text('video');
      $table->text('facebook');
      $table->text('twitter');
      $table->text('youtube');
      $table->text('copyright');
      $table->timestamps();
    });

    DB::table('configuraciones')->insert(
      array(
        'logo' => '',
        'email' => '',
        'nosotros' => '',
        'contacto' => '',
        'libre' => '',
        'video' => '',
        'facebook' => '',
        'twitter' => '',
        'youtube' => '',
        'copyright' => ''
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
    Schema::dropIfExists('configuraciones');
  }
}
