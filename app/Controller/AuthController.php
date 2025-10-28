<?php

namespace App\Controller;

use App\Model\User;

class AuthController
{

    private $userModel;

    public function __construct()
    {
        $this->userModel = new User();
    }

    public function loginForm()
    {
        session_start();
        require __DIR__ . '/../View/auth/login.php';
    }


    public function login()
    {
        if (session_status() === PHP_SESSION_NONE) session_start();

        $email = $_POST['email'] ?? '';
        $password = $_POST['password'] ?? '';

        $user = $this->userModel->findByEmail($email);
        if ($user && password_verify($password, $user['password'])) {
            $_SESSION['user'] = $user;
            header("Location: /?url=admin/products");
            exit;
        }

        $_SESSION['error'] = "Email ou senha inválidos.";
        header("Location: /?url=login");
        exit;
    }

    public function logout()
    {
        session_start();
        unset($_SESSION['user']);
        header("Location: /?url=login");
        exit;
    }
}
