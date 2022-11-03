<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application of SUPER USERS. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

//Documentación
Route::get("/documentacion","HomeController@documentacion");


//Rutas planes
Route::get("/planes","Admin\PlanController@index");
Route::get("/get-planes","Admin\PlanController@get");
Route::get("/get-all-planes","Admin\PlanController@getAll");
Route::get("/delete-plan/{id}","Admin\PlanController@delete");
Route::post("/plan","Admin\PlanController@store");
Route::post("/plan/{id}","Admin\PlanController@update");


//Rutas de configuracion global
Route::get("/globales","HomeController@globales");
Route::post("/globales","HomeController@setGlobales");


//Rutas sistemas
Route::get("/sistemas","Admin\SistemaController@index");
Route::post("/cambiar-contraseña-sistema","Admin\SistemaController@changePass");


Route::get("/get-sistemas","Admin\SistemaController@get");
Route::get("/delete-sistema/{id}","Admin\SistemaController@delete");
Route::post("/sistema","Admin\SistemaController@store");
Route::post("/sistema/{id}","Admin\SistemaController@update");
Route::get("/controlar-sistema/{id}","Admin\SistemaController@controlar");


//Rutas IMPUESTOS
Route::get("/impuestos","Admin\ImpuestoController@index");
Route::get("/get-impuestos","Admin\ImpuestoController@get");
Route::get("/get-all-impuestos","Admin\ImpuestoController@getAll");
Route::get("/delete-impuesto/{id}","Admin\ImpuestoController@delete");
Route::post("/impuesto/{id?}","Admin\ImpuestoController@store");