<?php 

require_once __DIR__.'/../vendor/autoload.php';
require_once __DIR__.'/../routes/web.php';

use App\Core\Router;

$router->dispatch();

?>