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
        if (session_status() === PHP_SESSION_NONE) session_start();
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
            header("Location: ?url=admin/products");
            exit;
        }

        $_SESSION['error'] = "Email ou senha inválidos.";
        header("Location: ?url=auth/login");
        exit;
    }

    public function logout()
    {
        if (session_status() === PHP_SESSION_NONE) session_start();
        unset($_SESSION['user']);
        header("Location: ?url=auth/login");
        exit;
    }

    public function registerForm()
    {
        if (session_status() === PHP_SESSION_NONE) session_start();

        require __DIR__ . '/../View/auth/register.php';
    }

    public function register()
    {
        if (session_status() === PHP_SESSION_NONE) session_start();

        $name = trim($_POST['name']) ?? '';
        $email = trim($_POST['email']) ?? '';
        $password = $_POST['password'] ?? '';
        $password_confirm = $_POST['password_confirm'] ?? '';

        $errors = [];

        if (empty($name)) {
            $errors[] = "Nome é obrigatório.";
        }

        // Verifica se email está vazio ou inválido
        if (empty($email) || !filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $errors[] = "Email inválido.";
        }

        if (strlen($password) < 6) {
            $errors[] = "A senha deve ter mais de 6 dígitos.";
        } elseif ($password !== $password_confirm) {
            $errors[] = "Senhas não coincidem.";
        }

        if (empty($errors)) {
            $existing = $this->userModel->findByEmail($email);
            if ($existing) {
                $errors[] = "Email já cadastrado.";
            }
        }
        if (!empty($errors)) {
            $_SESSION['errors'] = $errors;
            $_SESSION['old'] = ['name' => $name, 'email' => $email];
            header("Location: ?url=auth/register");
            exit;
        }

        $created = $this->userModel->create($name, $email, $password);
        if ($created) {
            $_SESSION['success'] = "Registro realizado com sucesso. Faça login.";
            header("Location: ?url=auth/login");
            exit;
        } else {
            $_SESSION['errors'] = ["Erro ao registrar usuário. Tente novamente."];
            header("Location: ?url=auth/register");
            exit;
        }
    }
}
