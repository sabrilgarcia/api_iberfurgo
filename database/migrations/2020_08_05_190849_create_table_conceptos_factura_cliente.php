<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTableConceptosFacturaCliente extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('conceptos_factura_cliente', function (Blueprint $table) {
            $table->string('concepto_factura_cliente_id',80)->primary()->nullable();
            $table->string('concepto_factura_cliente')->nullable();
            $table->integer('orden')->nullable();
            $table->string('unidad')->nullable();
            $table->boolean('manual')->nullable();
            $table->string('formato_unidad')->nullable();
            $table->string('formato_cantidad')->nullable();
            $table->string('concepto_padre')->nullable();
            $table->string('cuenta_contable')->nullable();
            $table->boolean('contrato_alquiler')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('conceptos_factura_cliente', function (Blueprint $table) {
            $table->dropSoftDeletes();
        });
        Schema::dropIfExists('conceptos_factura_cliente');
    }
}
