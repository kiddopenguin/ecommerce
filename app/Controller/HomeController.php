<?php

// O controller não imprime o HTML diretamente, ele apenas trabalha decidindo qual view vai apresentar para o usuário.

namespace App\Controller;

class HomeController
{

    /**
     * Método responsável por renderizar a view
     *
     * @param string $view
     * @param array $data
     * @return View
     */
    public function render($view, $data = [])
    {
        extract($data); // Transforma o array em variáveis
        require __DIR__ . "/../View/{$view}.php";
    }

    /**
     * Método responsável por retornar a view
     *
     * @return View
     */
    public function index()
    {
        $this->render('home');
    }

    /**
     * Método responsável por retornar a view
     *
     * @return View
     */
    public function sobre()
    {
        $this->render('sobre');
    }
}
