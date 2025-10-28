<?php

// É onde se registram todas as rotas do sistema


use App\Core\Router;

$authMiddleware = function () {
    if (isset($_SESSION['user'])) {
        header('Location: ?url=auth/login');
        exit;
    }
};


$router = new Router;

// Rotas Públicas

// /
$router->add('GET', '/', 'HomeController@index');

// /sobre
$router->add('GET', 'sobre', 'HomeController@sobre');

// Login/Logout
$router->add('GET', 'auth/login', 'AuthController@loginForm');
$router->add('POST', 'login', 'AuthController@login');
$router->add('GET', 'logout', 'AuthController@logout');

// Cadastro
$router->add('GET', 'auth/register', 'AuthController@registerForm');
$router->add('POST', 'register', 'AuthController@register');

// Painel Usuários
$router->group('admin/users', function ($router, $prefix) use ($authMiddleware) {
    // index
    $router->add('GET', "$prefix", 'UserController@index', $authMiddleware);
    // create
    $router->add('GET', "$prefix/create", 'UserController@create', $authMiddleware);
    // cadastrar
    $router->add('POST', "$prefix/store", 'UserController@store', $authMiddleware);
    // edit
    $router->add('GET', "$prefix/edit/{id}", 'UserController@edit', $authMiddleware);
    // update
    $router->add('POST', "$prefix/update/{id}", 'UserController@update', $authMiddleware);
    // delete
    $router->add('GET', "$prefix/delete/{id}", 'UserController@delete', $authMiddleware);
    // show
    $router->add('GET', "$prefix/show/{id}", 'UserController@show', $authMiddleware);
});

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
    $router->add('POST', "$prefix/update/{id}", 'ProductController@update', $authMiddleware);
    // delete
    $router->add('GET', "$prefix/delete/{id}", 'ProductController@delete', $authMiddleware);
});
