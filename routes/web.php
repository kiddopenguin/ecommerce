<?php

// É onde se registram todas as rotas do sistema


use App\Core\Router;

$authMiddleware = function () {
    if (!isset($_SESSION['user'])) {
        header('Location: ?url=/');
        exit;
    }
};


$router = new Router;

// Rotas Públicas

// /
$router->add('GET', '/', 'HomeController@index');

// /sobre
$router->add('GET', 'sobre', 'HomeController@sobre');

// Painel Administrativo

$router->group('admin/products', function ($router, $prefix) use ($authMiddleware) {
    // index
    $router->add('GET', "$prefix", 'ProductController@index', $authMiddleware);
    // create
    $router->add('GET', "$prefix/create", 'ProductController@create', $authMiddleware);
    // cadastrar
    $router->add('POST', "$prefix/store", 'ProductController@store', $authMiddleware);
    // edit
    $router->add('GET', "$prefix/edit/{id}", 'ProductController@edit', $authMiddleware);
    // update
    $router->add('GET', "$prefix/update/{id}", 'ProductController@update', $authMiddleware);
    // delete
    $router->add('GET', "$prefix/delete/{id}", 'ProductController@delete', $authMiddleware);
});
