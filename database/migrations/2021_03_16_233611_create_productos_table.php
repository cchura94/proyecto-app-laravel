<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('productos', function (Blueprint $table) {
            $table->id();
            
            $table->string("nombre");
            $table->decimal("precio", 10, 2)->default(0);
            $table->integer("cantidad")->default(1);
            $table->text("descripcion")->nullable();
            $table->string("imagen")->nullable();
            $table->boolean("estado")->default(true);
            $table->bigInteger("categoria_id")->unsigned();
            // relacion de  1 : N
            $table->foreign("categoria_id")->references("id")->on("categorias");

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
        Schema::dropIfExists('productos');
    }
}
