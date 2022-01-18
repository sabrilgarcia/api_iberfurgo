<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTableTarifas extends Migration
{
     /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tarifas', function (Blueprint $table) {
            $table->integer('tarifa_id')->primary();
            $table->integer('tarifa_tramo_id');
            $table->string('grupo_tarificacion_id',20);
            $table->string('concepto_factura_cliente_id',80);
            $table->float('importe', 6, 2);
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('tarifa_tramo_id')->references('tarifa_tramo_id')->on('tarifas_tramos');
            $table->foreign('grupo_tarificacion_id')->references('grupo_tarificacion_id')->on('grupos_tarificacion');
            $table->foreign('concepto_factura_cliente_id')->references('concepto_factura_cliente_id')->on('conceptos_factura_cliente');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('tarifas', function($table) {
            $table->dropForeign('tarifas_tarifa_tramo_id_foreign');
            $table->dropForeign('tarifas_grupo_tarificacion_id_foreign');
            $table->dropForeign('tarifas_concepto_factura_cliente_id_foreign');
            $table->dropSoftDeletes();
        });

        Schema::dropIfExists('tarifas');
    }
}
