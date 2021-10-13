<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePedidosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pedidos', function (Blueprint $table) {
            $table->id();
            $table->string('id_dir')->nullable();
            $table->string('user')->nullable();
            $table->integer('total')->nullable();            
            $table->string('estado')->default('comprando');   
            $table->text('observaciones')->nullable();   
            $table->string('modo_pago')->nullable();   
            $table->string('estado_pago')->nullable();   
            $table->string('horario_envio')->nullable();   
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
        Schema::dropIfExists('pedidos');
    }
}
