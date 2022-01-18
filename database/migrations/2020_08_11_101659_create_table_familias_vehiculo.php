<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

class CreateTableFamiliasVehiculo extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('familias_vehiculo', function (Blueprint $table) {
            $table->string('familia_vehiculo_id',80)->primary();
            $table->string('familia_vehiculo');
            $table->timestamps();
            $table->softDeletes();
            }
        );

        DB::table('familias_vehiculo')->insert([

                    'familia_vehiculo_id' => 'MONOVOLUMEN',
                    'familia_vehiculo'    => 'Monovolumen',
            ]
        );

        DB::table('familias_vehiculo')->insert(
            array(
                'familia_vehiculo_id' => 'TODOTERRENO',
                'familia_vehiculo'    => 'Todoterreno',
                )
            );

        DB::table('familias_vehiculo')->insert(
            array(
                'familia_vehiculo_id' => 'TURISMO',
                'familia_vehiculo'    => 'Turismo',
                )
            );

        DB::table('familias_vehiculo')->insert(
            array(
                'familia_vehiculo_id' => 'COMERCIAL',
                'familia_vehiculo'    => 'Vehículo comercial',
                )
            );

        DB::table('familias_vehiculo')->insert(
            array(
                'familia_vehiculo_id' => 'ESPECIAL',
                'familia_vehiculo'    => 'Vehículo especial',
                )
            );
        }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('familias_vehiculo');
    }
}
