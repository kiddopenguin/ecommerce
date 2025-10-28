<?php
if (session_status() === PHP_SESSION_NONE) session_start();
$errors = $_SESSION['errors'] ?? [];
unset($_SESSION['errors']);

$old = $_SESSION['old'] ?? [];
unset($_SESSION['old']);
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <title>Novo Usuário</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f0f4f8;
        }

        .form-card {
            max-width: 500px;
            margin: 5% auto;
            background: #fff;
            border-radius: 10px;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.08);
            padding: 2rem;
        }

        .form-title {
            color: #0d6efd;
            font-weight: bold;
            text-align: center;
            margin-bottom: 1.5rem;
        }
    </style>
</head>

<body>
    <div class="form-card">
        <h3 class="form-title">Cadastrar Novo Usuário</h3>

        <?php if (!empty($errors)): ?>
            <div class="alert alert-danger">
                <ul class="mb-0">
                    <?php foreach ($errors as $err): ?>
                        <li><?= htmlspecialchars($err) ?></li>
                    <?php endforeach; ?>
                </ul>
            </div>
        <?php endif; ?>

        <form action="?url=admin/users/store" method="POST" novalidate>
            <div class="mb-3">
                <label for="name" class="form-label">Nome</label>
                <input
                    type="text"
                    name="name"
                    id="name"
                    class="form-control"
                    required
                    value="<?= htmlspecialchars($old['name'] ?? '') ?>">
            </div>

            <div class="mb-3">
                <label for="email" class="form-label">E-mail</label>
                <input
                    type="email"
                    name="email"
                    id="email"
                    class="form-control"
                    required
                    value="<?= htmlspecialchars($old['email'] ?? '') ?>">
            </div>

            <div class="mb-3">
                <label for="password" class="form-label">Senha</label>
                <input
                    type="password"
                    name="password"
                    id="password"
                    class="form-control"
                    minlength="6"
                    required>
            </div>

            <div class="mb-3">
                <label for="password_confirm" class="form-label">Confirmar Senha</label>
                <input
                    type="password"
                    name="password_confirm"
                    id="password_confirm"
                    class="form-control"
                    minlength="6"
                    required>
            </div>

            <button type="submit" class="btn btn-primary w-100">Salvar Usuário</button>
        </form>

        <div class="text-center mt-3">
            <a href="?url=admin/users" class="text-decoration-none">← Voltar à lista</a>
        </div>
    </div>
</body>

</html>