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

// home
$router->add('GET', 'admin/products', 'ProductController@index');

// create
$router->add('GET', 'admin/products/create', 'ProductController@create');

// cadastrar
$router->add('POST', 'admin/products/store', 'ProductController@store');

// edit
$router->add('GET', 'admin/products/edit/{id}', 'ProductController@edit');

// update
$router->add('POST', 'admin/products/update/{id}', 'ProductController@update');

// delete
$router->add('GET', 'admin/products/delete/{id}', 'ProductController@delete');
