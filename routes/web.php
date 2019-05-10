<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It is a breeze. Simply tell Lumen the URIs it should respond to
| and give it the Closure to call when that URI is requested.
|
*/

/** @var \Laravel\Lumen\Routing\Router $router */

$router->post('recipes', 'RecipesController@store');
$router->get('recipes/{recipe}', 'RecipesController@show');

$router->post('recipes/{recipe}/ingredients', 'IngredientsController@store');
