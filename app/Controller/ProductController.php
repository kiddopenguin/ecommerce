<?php

namespace App\Controller;

use App\Model\Product;

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

class ProductController
{
    private $productModel;

    public function __construct()
    {
        $this->productModel = new Product();
    }

    public function render($view, $data = [])
    {
        extract($data);
        require __DIR__ . "/../View/{$view}.php";
    }

    public function index()
    {
        $products = $this->productModel->all();
        $this->render('admin/products/index', ['products' => $products]);
    }

    public function create()
    {
        $this->render('admin/products/create');
    }

    public function store()
    {
        $data = $_POST;

        $errors = $this->validate($data);

        if (!empty($errors)) {
            $_SESSION['errors'] = $errors;
            $_SESSION['old'] = $data;
            header('Location: ?url=admin/products/create');
            exit;
        }

        $this->productModel->create($data);
        $_SESSION['success'] = "Produto criado com sucesso!";
        header('Location: ?url=admin/products');
        exit;
    }

    public function edit($id)
    {
        $product = $this->productModel->find($id);
        $this->render('admin/products/edit', ['product' => $product]);
    }

    public function update($id)
    {
        $data = $_POST;

        $errors = $this->validate($data);

        if (!empty($errors)) {
            $_SESSION['errors'] = $errors;
            $_SESSION['old'] = $data;
            header("Location: ?url=admin/products/edit/$id");
            exit;
        }

        $this->productModel->update($id, $data);
        $_SESSION['success'] = "Produto atualizado com sucesso!";
        header('Location: ?url=admin/products');
        exit;
    }

    public function delete($id)
    {
        $this->productModel->delete($id);
        $_SESSION['success'] = "Produto excluído com sucesso!";
        header('Location: ?url=admin/products');
        exit;
    }

    private function validate($data)
    {
        $errors = [];

        if (empty($data['name'])) {
            $errors[] = "O campo nome é obrigatório.";
        }

        if (!isset($data['price']) || !is_numeric($data['price'])) {
            $errors[] = "O campo preço deve ser um número válido.";
        }

        return $errors;
    }
}
