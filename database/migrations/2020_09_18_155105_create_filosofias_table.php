<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFilosofiasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('filosofias', function (Blueprint $table) {
            $table->increments('id');
            $table->text('titulo1');
            $table->text('texto1');
            $table->text('titulo2');
            $table->text('texto2');
            $table->text('titulo3');
            $table->text('texto3');
            $table->text('titulo4');
            $table->text('texto4');
            $table->text('texto5');
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
        Schema::dropIfExists('filosofias');
    }
}
