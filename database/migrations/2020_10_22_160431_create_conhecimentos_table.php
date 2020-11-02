<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateConhecimentosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('conhecimentos', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('numero_cte')->nullable();
            $table->string('nota_fiscal')->nullable();
            $table->integer('nota_valor')->nullable();
            $table->integer('nota_volume')->nullable();
            $table->integer('nota_peso')->nullable();
            $table->integer('valor_frete')->nullable();
            $table->date('data_emissao')->nullable();
            $table->string('tomador')->nullable();
            $table->string('remetente')->nullable();
            $table->string('destinatario')->nullable();
            $table->string('motorista')->nullable();
            $table->string('proprietario')->nullable();
            $table->string('cidade_origem')->nullable();
            $table->string('cidade_destino')->nullable();
            $table->string('situacao')->nullable();
            $table->string('tipo_cte')->nullable();
            $table->string('mercadoria')->nullable();
            $table->string('placa')->nullable();
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
        Schema::dropIfExists('conhecimentos');
    }
}
