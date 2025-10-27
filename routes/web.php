<?php

// É onde se registram todas as rotas do sistema


use App\Core\Router;

$router = new Router;

// Rotas Públicas

// /
$router->add('GET', '/', 'HomeController@index');

// /sobre
$router->add('GET', 'sobre', 'HomeController@sobre');

// Painel Administrativo

$router->group('admin/products', function ($router, $prefix) {
    // index
    $router->add('GET', "$prefix", 'ProductController@index');
    // create
    $router->add('GET', "$prefix/create", 'ProductController@create');
    // cadastrar
    $router->add('POST', "$prefix/store", 'ProductController@store');
    // edit
    $router->add('GET', "$prefix/edit/{id}", 'ProductController@edit');
    // update
    $router->add('GET', "$prefix/update/{id}", 'ProductController@update');
    // delete
    $router->add('GET', "$prefix/delete/{id}", 'ProductController@delete');
});