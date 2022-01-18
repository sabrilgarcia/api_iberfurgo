<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTableTiposVehiculo extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tipos_vehiculo', function (Blueprint $table) {
            $table->string('tipo_vehiculo_id',30)->primary();
            $table->string('tipo_vehiculo',200);
            $table->string('familia_vehiculo_id',80);
            $table->string('grupo_tarificacion_id',80);
            $table->float('fianza', 6, 2);
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('familia_vehiculo_id')->references('familia_vehiculo_id')->on('familias_vehiculo');
            $table->foreign('grupo_tarificacion_id')->references('grupo_tarificacion_id')->on('grupos_tarificacion');
        });

        DB::table('tipos_vehiculo')->insert([
            'tipo_vehiculo_id'      => 'CARCONPLA',
            'tipo_vehiculo'         => 'Carrozado con plataforma 20 m3',
            'familia_vehiculo_id'   => 'COMERCIAL',
            'grupo_tarificacion_id' => 'G+',
            'fianza'                => '450',
        ]);

        DB::table('tipos_vehiculo')->insert([
            'tipo_vehiculo_id'      => 'CARCONPLA16',
            'tipo_vehiculo'         => 'Carrozado con plataforma 16 m3',
            'familia_vehiculo_id'   => 'COMERCIAL',
            'grupo_tarificacion_id' => 'G',
            'fianza'                => '450',
        ]);

        DB::table('tipos_vehiculo')->insert([
            'tipo_vehiculo_id'      => 'CARISO',
            'tipo_vehiculo'         => 'Carrozado isotermado 16m3',
            'familia_vehiculo_id'   => 'ESPECIAL',
            'grupo_tarificacion_id' => 'P',
            'fianza'                => '450',
        ]);

        DB::table('tipos_vehiculo')->insert([
            'tipo_vehiculo_id'      => 'CARSINPLA16',
            'tipo_vehiculo'         => 'Carrozado sin plataforma 16 m3',
            'familia_vehiculo_id'   => 'COMERCIAL',
            'grupo_tarificacion_id' => 'F',
            'fianza'                => '450',
        ]);

        DB::table('tipos_vehiculo')->insert([
            'tipo_vehiculo_id'      => 'CSP+',
            'tipo_vehiculo'         => 'Carrozado sin plataforma 20 m3',
            'familia_vehiculo_id'   => 'COMERCIAL',
            'grupo_tarificacion_id' => 'F+',
            'fianza'                => '450',
        ]);

        DB::table('tipos_vehiculo')->insert([
            'tipo_vehiculo_id'      => 'DERTUR2',
            'tipo_vehiculo'         => 'Derivado turismo 2,4 - 3 m3',
            'familia_vehiculo_id'   => 'COMERCIAL',
            'grupo_tarificacion_id' => 'A',
            'fianza'                => '300',
        ]);

        DB::table('tipos_vehiculo')->insert([
            'tipo_vehiculo_id'      => 'DERTUR1',
            'tipo_vehiculo'         => 'Derivado turismo 4 m3',
            'familia_vehiculo_id'   => 'COMERCIAL',
            'grupo_tarificacion_id' => 'A+',
            'fianza'                => '300',
        ]);

        DB::table('tipos_vehiculo')->insert([
            'tipo_vehiculo_id'      => 'DERTURCOMBI',
            'tipo_vehiculo'         => 'Derivado turismo 5 plazas',
            'familia_vehiculo_id'   => 'COMERCIAL',
            'grupo_tarificacion_id' => 'A',
            'fianza'                => '300',
        ]);

        DB::table('tipos_vehiculo')->insert([
            'tipo_vehiculo_id'      => 'FUR9P',
            'tipo_vehiculo'         => 'Furgoneta 9 plazas',
            'familia_vehiculo_id'   => 'COMERCIAL',
            'grupo_tarificacion_id' => 'I',
            'fianza'                => '450',
        ]);

        DB::table('tipos_vehiculo')->insert([
            'tipo_vehiculo_id'      => 'FURADA',
            'tipo_vehiculo'         => 'Furgoneta adaptada',
            'familia_vehiculo_id'   => 'ESPECIAL',
            'grupo_tarificacion_id' => 'M',
            'fianza'                => '300',
        ]);

        DB::table('tipos_vehiculo')->insert([
            'tipo_vehiculo_id'      => 'FUREXTGRA',
            'tipo_vehiculo'         => 'Furgoneta extra grande 12 - 13 m3',
            'familia_vehiculo_id'   => 'COMERCIAL',
            'grupo_tarificacion_id' => 'E',
            'fianza'                => '450',
        ]);

        DB::table('tipos_vehiculo')->insert([
            'tipo_vehiculo_id'      => 'FUREXTGRA+',
            'tipo_vehiculo'         => 'Furgoneta extra grande 14 - 17 m3',
            'familia_vehiculo_id'   => 'COMERCIAL',
            'grupo_tarificacion_id' => 'E+',
            'fianza'                => '450',
        ]);

        DB::table('tipos_vehiculo')->insert([
            'tipo_vehiculo_id'      => 'FURGRA',
            'tipo_vehiculo'         => 'Furgoneta grande 10 - 12 m3',
            'familia_vehiculo_id'   => 'COMERCIAL',
            'grupo_tarificacion_id' => 'D',
            'fianza'                => '300',
        ]);

        DB::table('tipos_vehiculo')->insert([
            'tipo_vehiculo_id'      => 'FURGISOMP',
            'tipo_vehiculo'         => 'FURGONETA ISOTERMADA 6 m3',
            'familia_vehiculo_id'   => 'ESPECIAL',
            'grupo_tarificacion_id' => 'B+IS',
            'fianza'                => '300',
        ]);

        DB::table('tipos_vehiculo')->insert([
            'tipo_vehiculo_id'      => 'FURGISOMED',
            'tipo_vehiculo'         => 'Furgoneta isotermada mediana 11 m3',
            'familia_vehiculo_id'   => 'ESPECIAL',
            'grupo_tarificacion_id' => 'N',
            'fianza'                => '450',
        ]);

        DB::table('tipos_vehiculo')->insert([
            'tipo_vehiculo_id'      => 'FURGISOPEQ',
            'tipo_vehiculo'         => 'Furgoneta isotermada pequeña 1,9 m3',
            'familia_vehiculo_id'   => 'ESPECIAL',
            'grupo_tarificacion_id' => 'A-B',
            'fianza'                => '300',
        ]);

        DB::table('tipos_vehiculo')->insert([
            'tipo_vehiculo_id'      => 'FURMED',
            'tipo_vehiculo'         => 'Furgoneta mediana 8 - 10 m3',
            'familia_vehiculo_id'   => 'COMERCIAL',
            'grupo_tarificacion_id' => 'C',
            'fianza'                => '300',
        ]);

        DB::table('tipos_vehiculo')->insert([
            'tipo_vehiculo_id'      => 'FURMIX',
            'tipo_vehiculo'         => 'Furgoneta mixta 6 plazas',
            'familia_vehiculo_id'   => 'COMERCIAL',
            'grupo_tarificacion_id' => 'H',
            'fianza'                => '300',
        ]);

        DB::table('tipos_vehiculo')->insert([
            'tipo_vehiculo_id'      => 'FURMIX+',
            'tipo_vehiculo'         => 'Furgoneta Mixta 6 plazas Larga',
            'familia_vehiculo_id'   => 'COMERCIAL',
            'grupo_tarificacion_id' => 'H+',
            'fianza'                => '300',
        ]);

        DB::table('tipos_vehiculo')->insert([
            'tipo_vehiculo_id'      => 'FURPEQ',
            'tipo_vehiculo'         => 'Furgoneta pequeña 6 - 8 m3',
            'familia_vehiculo_id'   => 'COMERCIAL',
            'grupo_tarificacion_id' => 'B',
            'fianza'                => '300',
        ]);

        DB::table('tipos_vehiculo')->insert([
            'tipo_vehiculo_id'      => 'MON7',
            'tipo_vehiculo'         => 'Monovolumen 7 plazas',
            'familia_vehiculo_id'   => 'MONOVOLUMEN',
            'grupo_tarificacion_id' => 'H+',
            'fianza'                => '300',
        ]);

        DB::table('tipos_vehiculo')->insert([
            'tipo_vehiculo_id'      => 'MON',
            'tipo_vehiculo'         => 'Monovolumen 9 plazas VIP',
            'familia_vehiculo_id'   => 'MONOVOLUMEN',
            'grupo_tarificacion_id' => 'J',
            'fianza'                => '450',
        ]);

        DB::table('tipos_vehiculo')->insert([
            'tipo_vehiculo_id'      => 'MONEXE',
            'tipo_vehiculo'         => 'Monovolumen 9 plazas VIP EXECUTIVE',
            'familia_vehiculo_id'   => 'MONOVOLUMEN',
            'grupo_tarificacion_id' => 'O',
            'fianza'                => '450',
        ]);

        DB::table('tipos_vehiculo')->insert([
            'tipo_vehiculo_id'      => 'TT',
            'tipo_vehiculo'         => 'Todo Terreno',
            'familia_vehiculo_id'   => 'TODOTERRENO',
            'grupo_tarificacion_id' => 'O',
            'fianza'                => '450',
        ]);

        DB::table('tipos_vehiculo')->insert([
            'tipo_vehiculo_id'      => 'TTGRAN',
            'tipo_vehiculo'         => 'Todo Terreno Grande',
            'familia_vehiculo_id'   => 'TODOTERRENO',
            'grupo_tarificacion_id' => 'R',
            'fianza'                => '300',
        ]);

        DB::table('tipos_vehiculo')->insert([
            'tipo_vehiculo_id'      => 'TTMED',
            'tipo_vehiculo'         => 'Todo Terreno SUV mediano',
            'familia_vehiculo_id'   => 'TODOTERRENO',
            'grupo_tarificacion_id' => 'L',
            'fianza'                => '300',
        ]);

        DB::table('tipos_vehiculo')->insert([
            'tipo_vehiculo_id'      => 'TURMED',
            'tipo_vehiculo'         => 'Turismo mediano',
            'familia_vehiculo_id'   => 'TURISMO',
            'grupo_tarificacion_id' => 'L',
            'fianza'                => '300',
        ]);

        DB::table('tipos_vehiculo')->insert([
            'tipo_vehiculo_id'      => 'TURPEQ',
            'tipo_vehiculo'         => 'Turismo pequeño',
            'familia_vehiculo_id'   => 'TURISMO',
            'grupo_tarificacion_id' => 'K',
            'fianza'                => '300',
        ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('tipos_vehiculo', function (Blueprint $table) {
            $table->dropForeign('tipos_vehiculo_familia_vehiculo_id_foreign');
            $table->dropForeign('tipos_vehiculo_grupo_tarificacion_id_foreign');
            $table->dropSoftDeletes();
        });

        Schema::dropIfExists('tipos_vehiculo');
    }
}
