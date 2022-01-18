<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTableTiposTarifa extends Migration
{
     /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tipos_tarifa', function (Blueprint $table) {
            $table->string('tipo_tarifa_id',20)->primary();
            $table->string('tipo_tarifa')->nullable();
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
        Schema::table('tipos_tarifa', function (Blueprint $table) {
            $table->dropSoftDeletes();
        });
        Schema::dropIfExists('tipos_tarifa');
    }
}
