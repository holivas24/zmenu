<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class VentasProductos extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::create('ventas_productos', function (Blueprint $table) {
            $table->increments('id');
            $table->double('precio');
            $table->integer('cantidad');
            $table->double('total');
            $table->integer('producto_id')->unsigned();
            $table->foreign('producto_id')->references('id')->on('productos');
            $table->integer('venta_id')->unsigned();
            $table->foreign('venta_id')->references('id')->on('ventas');
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        Schema::dropIfExists('ventas_productos');
    }

}
