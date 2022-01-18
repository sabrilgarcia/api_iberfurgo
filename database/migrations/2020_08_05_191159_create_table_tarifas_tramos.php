<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTableTarifasTramos extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tarifas_tramos', function (Blueprint $table) {
            $table->integer('tarifa_tramo_id')->primary();
            $table->integer('tarifa_periodo_id');
            $table->integer('dias_inicio')->nullable();
            $table->integer('dias_fin')->nullable();
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('tarifa_periodo_id')->references('tarifa_periodo_id')->on('tarifas_periodos');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('tarifas_tramos', function($table) {
            $table->dropForeign('tarifas_tramos_tarifa_periodo_id_foreign');
            $table->dropSoftDeletes();
        });
        Schema::dropIfExists('tarifas_tramos');
    }
}
