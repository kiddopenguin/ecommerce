<?php
if (session_status() === PHP_SESSION_NONE) session_start();

$success = $_SESSION['success'] ?? '';
unset($_SESSION['success']);
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Painel de Produtos</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f0f4f8; /* tom frio */
        }
        .container {
            margin-top: 50px;
        }
        .btn-new {
            background-color: #0d6efd;
            border: none;
        }
        .btn-new:hover {
            background-color: #0b5ed7;
        }
        .table thead {
            background-color: #0d6efd;
            color: #fff;
        }
        .btn-sm-warning {
            background-color: #ffc107;
            border: none;
        }
        .btn-sm-warning:hover {
            background-color: #e0a800;
        }
        .btn-sm-danger {
            background-color: #dc3545;
            border: none;
        }
        .btn-sm-danger:hover {
            background-color: #bb2d3b;
        }
    </style>
</head>
<body>
<div class="container">
    <h1 class="mb-4 text-center">Painel de Produtos</h1>

    <?php if (!empty($success)): ?>
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <?= htmlspecialchars($success) ?>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    <?php endif; ?>

    <div class="d-flex justify-content-end mb-3">
        <a href="?url=admin/products/create" class="btn btn-new">+ Novo Produto</a>
    </div>

    <div class="table-responsive">
        <table class="table table-striped table-bordered align-middle">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nome</th>
                    <th>Descrição</th>
                    <th>Preço</th>
                    <th class="text-center">Ações</th>
                </tr>
            </thead>
            <tbody>
            <?php if (!empty($products)): ?>
                <?php foreach ($products as $product): ?>
                    <tr>
                        <td><?= $product['id'] ?></td>
                        <td><?= htmlspecialchars($product['name']) ?></td>
                        <td><?= htmlspecialchars($product['description']) ?></td>
                        <td>R$ <?= number_format($product['price'], 2, ',', '.') ?></td>
                        <td class="text-center">
                            <a href="?url=admin/products/edit/<?= $product['id'] ?>" class="btn btn-sm btn-sm-warning">Editar</a>
                            <a href="?url=admin/products/delete/<?= $product['id'] ?>" class="btn btn-sm btn-sm-danger" onclick="return confirm('Tem certeza que deseja excluir?')">Excluir</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            <?php else: ?>
                <tr>
                    <td colspan="5" class="text-center">Nenhum produto encontrado.</td>
                </tr>
            <?php endif; ?>
            </tbody>
        </table>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
