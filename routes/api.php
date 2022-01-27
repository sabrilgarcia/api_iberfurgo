<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::group(
    [
        'prefix' => 'v1'
    ],  function ()
        {
            Route::post('login', 'UserController@login');
            Route::post('register', 'UserController@register');
            Route::post('refreshtoken', 'UserController@refreshToken');
            Route::get('/unauthorized', 'UserController@unauthorized');

            Route::middleware('auth.apikey')->group(function ()
                {
                    Route::post('logout', 'UserController@logout');
                    Route::post('details', 'UserController@details');
                    Route::resource('flota-modelo', ModeloController::class);
                    // Route::resource('flota-marca', MarcaController::class);
                    Route::resource('flota-tipo', TipoController::class);
                    Route::resource('maestro-delegacion', DelegacionController::class);
                    Route::resource('maestro-delegacion-datos-web', DelegacionDatosWebController::class);
                    Route::resource('maestro-tarifa', TarifaController::class);
                    Route::resource('maestro-provincia', ProvinciaController::class);
                    Route::resource('reservas-web', ReservaController::class);
                    Route::resource('contacto-web', ContactoController::class);
                    
                    Route::resource('modulos' , 'Soporte\ModuloController');
                    Route::resource('categorias' , 'Soporte\CategoriaController');
                    Route::resource('prioridades' , 'Soporte\PrioridadController');
                    Route::resource('estados' , 'Soporte\EstadoController');
                    Route::resource('tickets' , 'Soporte\TicketController');

                    Route::resource('ofertas' , 'Ofertas\OfertaController');

                    Route::get('get-tarifa', 'TarifaController@getTarifa');
                    Route::get('get-tipos-vehiculo' , 'TipoController@get_enum_values');
                    Route::get('get-familias-vehiculo', 'TipoController@getFamiliasVehiculo');
                }
            );
        }
);


