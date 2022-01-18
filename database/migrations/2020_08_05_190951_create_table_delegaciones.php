<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTableDelegaciones extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('delegaciones', function (Blueprint $table) {
            $table->string('delegacion_id',50)->primary();
            $table->integer('empresa_id');
            $table->string('nombre')->nullable();
            $table->text('direccion')->nullable();
            $table->string('codigo_postal')->nullable();
            $table->string('poblacion_id')->nullable();
            $table->string('cuenta_contable_contado')->nullable();
            $table->string('serie_factura')->nullable();
            $table->string('observaciones')->nullable();
            $table->boolean('activa')->nullable();
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
        Schema::table('delegaciones', function (Blueprint $table) {
            $table->dropSoftDeletes();
        });
        Schema::dropIfExists('delegaciones');
    }
}
