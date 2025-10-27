<?php
// O Router é o coração do sistema, ele é encarregado de ler as URLs acessadas, descobrir quais controllers e quais métodos são chamados e passar parâmetros, caso existam.
// Ler a URL acessada (por exemplo: /produtos/listar).
// Descobrir qual controller e qual método devem ser chamados.
// Passar parâmetros, se existirem (ex: /produto/editar/5).

namespace App\Core;

class Router
{

    private $routes = [];

    public function add($method, $route, $action, $middleware = null)
    {
        $this->routes[] = [
            'method' => strtoupper($method),
            'route' => trim($route, '/'),
            'action' => $action,
            'middleware' => $middleware
        ];
    }


    public function dispatch()
    {
        $uri = $_GET['url'] ?? '/';
        $uri = trim($uri, '/');
        $method = $_SERVER['REQUEST_METHOD'];

        foreach ($this->routes as $route) {
            if ($route['method'] !== $method) continue;

            $pattern = preg_replace('#\{[\w]+\}#', '([\w-]+)', $route['route']);
            $pattern = "#^{$pattern}$#";

            if (preg_match($pattern, $uri, $matches)) {
                array_shift($matches); // Remove o match completo

                // Se houver middleware, executa antes da ação
                if ($route['middleware']) {
                    call_user_func($route['middleware']);
                }

                return $this->callAction($route['action'], $matches);
            }
        }

        http_response_code(404);
        echo "Página não encontrada";
    }


    private function callAction($action, $params = [])
    {
        if (is_callable($action)) {
            return call_user_func_array($action, $params);
        }

        if (is_string($action)) {
            [$controller, $method] = explode('@', $action);
            $controller = "App\\Controller\\{$controller}";

            if (class_exists($controller)) {
                $obj = new $controller;
                if (method_exists($obj, $method)) {
                    return call_user_func_array([$obj, $method], $params);
                }
            }
        }

        throw new \Exception("Rota Inválida");
    }

    public function group($prefix, $callback) {
        $callback($this, trim($prefix, '/'));
    }
}
