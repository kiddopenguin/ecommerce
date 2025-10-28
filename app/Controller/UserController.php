<?php

namespace App\Controller;

use App\Model\User;

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

class UserController
{
    private $userModel;

    public function __construct()
    {
        $this->userModel = new User();
    }

    public function render($view, $data = [])
    {
        extract($data);
        require dirname(__DIR__) . '/View/admin/users/'.$view.'.php';
    }

    public function index()
    {
        $users = $this->userModel->all();
        $this->render('index', ['users' => $users]);
    }

    public function create()
    {
        $this->render('create');
    }

    public function store()
    {
        session_start();

        $name = trim($_POST['name'] ?? '');
        $email = trim($_POST['email'] ?? '');
        $password = $_POST['password'] ?? '';
        $password_confirm = $_POST['password_confirm'] ?? '';

        $errors = [];

        if (empty($name)) $errors[] = "O nome é obrigatório.";
        if (empty($email) || !filter_var($email, FILTER_VALIDATE_EMAIL)) $errors[] = "E-mail inválido.";
        if (strlen($password) < 6) $errors[] = "A senha deve ter pelo menos 6 caracteres.";
        if ($password !== $password_confirm) $errors[] = "As senhas não coincidem.";

        if ($this->userModel->findByEmail($email)) {
            $errors[] = "E-mail já cadastrado.";
        }

        if (!empty($errors)) {
            $_SESSION['errors'] = $errors;
            $_SESSION['old'] = ['name' => $name, 'email' => $email];
            header('Location: ?url=admin/users/create');
            exit;
        }

        $this->userModel->create($name, $email, $password);
        $_SESSION['success'] = "Usuário criado com sucesso!";
        header('Location: ?url=admin/users');
        exit;
    }

    public function edit($id)
    {
        $user = $this->userModel->find($id);
        if (!$user) {
            echo "Usuário não encontrado.";
            return;
        }
        $this->render('edit', compact('user'));
    }

    public function update($id)
    {
        session_start();

        $name = trim($_POST['name'] ?? '');
        $email = trim($_POST['email'] ?? '');
        $password = $_POST['password'] ?? '';

        $errors = [];

        if (empty($name) || empty($email)) {
            $errors[] = "Nome e e-mail são obrigatórios.";
        } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $errors[] = "E-mail inválido.";
        }

        if ($this->userModel->emailExists($email, $id)) {
            $errors[] = "E-mail já está em uso por outro usuário.";
        }

        if (!empty($errors)) {
            $_SESSION['errors'] = $errors;
            header("Location: ?url=admin/users/edit/{$id}");
            exit;
        }

        $this->userModel->update($id, $name, $email, $password);
        $_SESSION['success'] = "Usuário atualizado com sucesso!";
        header('Location: ?url=admin/users');
        exit;
    }

    public function delete($id)
    {
        session_start();
        $this->userModel->delete($id);
        $_SESSION['success'] = "Usuário removido com sucesso!";
        header('Location: ?url=admin/users');
        exit;
    }

    public function show($id)
    {
        $user = $this->userModel->find($id);
        if (!$user) {
            $_SESSION['error'] = "Usuário não encontrado.";
            header('Location: ?url=admin/users');
            exit;
        }
        $this->render('show', compact('user'));
    }
}
