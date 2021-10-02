<?php

/** @var \Laravel\Lumen\Routing\Router $router */

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

// $router->get('/', function () use ($router) {
//     return $router->app->version();
// });
$middleware = ['middleware' => 'auth'];
$router->group([], function () use ($router) {
    $router->get('/products', [
        'as' => 'products_index', 'uses' => 'ProductsController@index'
    ]);

    $router->post('/products', [
        'as' => 'products_create', 'uses' => 'ProductsController@create'
    ]);

    $router->put('/products/update{id}', [
        'as' => 'products_update', 'uses' => 'ProductsController@update'
    ]);

    $router->delete('/products/{id}', [
        'as' => 'products_destroy', 'uses' => 'ProductsController@destroy'
    ]);

    $router->get('/products/{id}', [
        'as' => 'products_show', 'uses' => 'ProductsController@show'
    ]);

    $router->get('/categories', [
        'as' => 'categories_index', 'uses' => 'CategoriesController@index'
    ]);
});
