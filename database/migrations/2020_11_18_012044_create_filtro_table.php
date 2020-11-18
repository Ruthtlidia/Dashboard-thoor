<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFiltroTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('filtro', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->longText('motorista')->nullable();
            $table->longText('total')->nullable();
            $table->longText('faturamento_frota')->nullable();
            $table->longText('total_receita')->nullable();
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
        Schema::dropIfExists('filtro');
    }
}
