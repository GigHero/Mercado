<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProdutoHasCompraTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('produto_has_compra', function (Blueprint $table) {
            
            $table->integer('produto_id');
            $table->integer('compra_id')->index('fk_compra_produto');
            $table->primary(['produto_id','compra_id']);
            $table->integer('quantidade');
            
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('produto_has_compra');
    }
}
