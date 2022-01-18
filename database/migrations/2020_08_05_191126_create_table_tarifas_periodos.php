<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTableTarifasPeriodos extends Migration
{
     /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tarifas_periodos', function (Blueprint $table) {
            $table->integer('tarifa_periodo_id')->primary();
            $table->string('tipo_tarifa_id',20);
            $table->string('delegacion_id',50);
            $table->dateTime('fecha_inicio')->nullable();
            $table->dateTime('fecha_fin')->nullable();
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('tipo_tarifa_id')->references('tipo_tarifa_id')->on('tipos_tarifa');
            $table->foreign('delegacion_id')->references('delegacion_id')->on('delegaciones');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('tarifas_periodos', function($table) {
            $table->dropForeign('tarifas_periodos_tipo_tarifa_id_foreign');
            $table->dropForeign('tarifas_periodos_delegacion_id_foreign');
            $table->dropSoftDeletes();
        });
        Schema::dropIfExists('tarifas_periodos');
    }
}
