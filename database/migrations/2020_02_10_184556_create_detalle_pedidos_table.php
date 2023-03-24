<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDetallePedidosTable extends Migration
{
  /**
   * Run the migrations.
   *
   * @return void
   */
  public function up()
  {
    Schema::create('detalle_pedidos', function (Blueprint $table) {
      $table->increments('id');
      $table->integer('id_pedido');
      $table->text('codigo');
      $table->text('nombre');
      $table->integer('cantidad');
      $table->decimal('precio_t', 8, 2);
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
    Schema::dropIfExists('detalle_pedidos');
  }
}
