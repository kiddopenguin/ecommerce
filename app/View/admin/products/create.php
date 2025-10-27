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
    <title>Novo Produto</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container mt-5">
    <h1 class="mb-4">Cadastrar Novo Produto</h1>

    <?php if (!empty($errors)): ?>
        <div class="alert alert-danger">
            <ul class="mb-0">
                <?php foreach ($errors as $error): ?>
                    <li><?= htmlspecialchars($error) ?></li>
                <?php endforeach; ?>
            </ul>
        </div>
    <?php endif; ?>

    <form action="?url=admin/products/store" method="POST">
        <div class="mb-3">
            <label class="form-label">Nome:</label>
            <input type="text" name="name" class="form-control" value="<?= htmlspecialchars($old['name'] ?? '') ?>" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Descrição:</label>
            <textarea name="description" class="form-control"><?= htmlspecialchars($old['description'] ?? '') ?></textarea>
        </div>

        <div class="mb-3">
            <label class="form-label">Preço:</label>
            <input type="number" name="price" step="0.01" class="form-control" value="<?= htmlspecialchars($old['price'] ?? '') ?>" required>
        </div>

        <button type="submit" class="btn btn-success">Salvar</button>
        <a href="?url=admin/products" class="btn btn-secondary">Voltar</a>
    </form>
</div>
</body>
</html>
