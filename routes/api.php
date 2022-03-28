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
                    Route::resource('maestro-provincia-datos-web', 'Maestro\ProvinciaDatosWebController');
                    Route::resource('maestro-tarifa', TarifaController::class);
                    Route::resource('maestro-provincia', ProvinciaController::class);
                    Route::resource('reservas-web', ReservaController::class);
                    Route::resource('contacto-web', ContactoController::class);
                    Route::get('get-tarifa', 'TarifaController@getTarifa');
                    Route::get('get-tarifa-free-day', 'TarifaController@getTarifaFreeDay');
                    Route::get('get-tipos-vehiculo' , 'TipoController@get_enum_values');
                    Route::get('get-familias-vehiculo', 'TipoController@getFamiliasVehiculo');


                    Route::resource('modulos' , 'Soporte\ModuloController');
                    Route::resource('categorias' , 'Soporte\CategoriaController');
                    Route::resource('prioridades' , 'Soporte\PrioridadController');
                    Route::resource('estados' , 'Soporte\EstadoController');
                    Route::resource('tickets' , 'Soporte\TicketController');
                    Route::resource('respuesta-ticket' , 'Soporte\RespuestaTicketController');

                    Route::resource('combustible' , 'Combustible\CombustibleController');

                    Route::resource('ofertas' , 'Ofertas\OfertaController');
                    Route::resource('ofertasVehiculo' , 'Ofertas\OfertaVehiculoController');
                    Route::resource('vehiculos' , 'Flota\VehiculoController');
                    Route::get('estadoVehiculosGrupo' , 'Flota\VehiculoController@estadoVehiculosGrupo');
                    Route::get('estadoVehiculo' , 'Flota\VehiculoController@estadoVehiculo');


                    Route::resource('vehiculosSeguros' , 'Flota\VehiculoSeguroController');
                    Route::resource('formasPago' , 'Maestro\FormaPagoController');


                    Route::resource('menu' , 'Menu\MenuController');

                    Route::resource('versiones' , 'Flota\VersionController');
                    Route::resource('versionesCaracteristicas' , 'Flota\VersionCaracteristicasController');
                    Route::resource('modelos' , 'Flota\ModeloController');
                    Route::resource('marcas' , 'Flota\MarcaController');

                    Route::resource('reservasWeb' , 'Reserva\ReservaWebController');

                    Route::resource('ordenFacturas', 'Operacion\OrdenFacturaController');
                    Route::resource('ordenItem', 'Operacion\OrdenItemController');
                    Route::resource('ordenes', 'Operacion\OrdenController');
                    Route::resource('ordenDetalle', 'Operacion\OrdenDetalleController');

                    Route::resource('facturaVehiculos', 'Cliente\FacturaVehiculoController');

                    Route::resource('clientes', 'Cliente\ClienteController');
                    Route::get('get-clientes-pendientes-facturar', 'Cliente\ClienteController@getClientesPendientesFacturar');

                    Route::resource('facturas', 'Cliente\ClienteFacturaController');
                    Route::get('numFacturas', 'Cliente\ClienteFacturaController@getNumFacturas');
                    Route::resource('facturasSearch', 'Cliente\FacturaSearchController');
                    Route::resource('facturasItem', 'Cliente\ClienteFacturaItemController');
                    
                    Route::resource('tipoProveedor', 'Proveedor\TipoProveedorController');

                    Route::resource('tiposProveedor' , 'Proveedor\TipoProveedorController');
                    Route::resource('proveedores' , 'Proveedor\ProveedorController');
                    Route::resource('proveedoresFactura' , 'Proveedor\ProveedorFacturaController');
                    Route::resource('proveedoresPagos' , 'Proveedor\ProveedorPagoController');

                    Route::get('facturacion-grupos', 'Operacion\OrdenFacturaController@getFacturacionGrupos');
                    Route::get('get-contratos-sin-facturas', 'Operacion\OrdenFacturaController@getContratosSinFactura');

                }
            );
        }
);


