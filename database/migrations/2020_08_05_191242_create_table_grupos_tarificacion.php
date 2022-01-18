<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTableGruposTarificacion extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('grupos_tarificacion', function (Blueprint $table) {
            $table->string('grupo_tarificacion_id',20)->primary();
            $table->string('grupo_tarificacion',30)->nullable();
            $table->integer('cargo_reduccion_franquicia')->nullable();
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
        Schema::table('grupos_tarificacion', function($table) {
            $table->dropSoftDeletes();
        });
        Schema::dropIfExists('grupos_tarificacion');
    }
}
