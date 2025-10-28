<?php 

require_once __DIR__.'/../vendor/autoload.php';

// Inicia a sessão de forma centralizada para evitar chamadas repetidas em controllers
if (session_status() === PHP_SESSION_NONE) {
	session_start();
}

require_once __DIR__.'/../routes/web.php';

use App\Core\Router;

$router->dispatch();

?>