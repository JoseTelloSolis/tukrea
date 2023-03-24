<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{
  /**
   * Run the migrations.
   *
   * @return void
   */
  public function up()
  {
    Schema::create('users', function (Blueprint $table) {
      $table->increments('id');
      $table->string('usuario');
      $table->string('password');
      $table->rememberToken();
      $table->timestamps();
    });

    DB::table('users')->insert(
      array(
        'usuario' => 'admin',
        'password' => bcrypt('1234')
      )
    );
  }

  public function down()
  {
    Schema::dropIfExists('users');
  }
}
