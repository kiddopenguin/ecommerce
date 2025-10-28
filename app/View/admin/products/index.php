<?php
$title = 'Painel de Produtos - Admin';
ob_start();
?>

<!-- Admin Header -->
<div class="admin-header mb-4">
    <div class="container py-4">
        <div class="row align-items-center">
            <div class="col">
                <h1 class="h2 mb-0 text-white">Painel de Produtos</h1>
            </div>
            <div class="col-auto">
                <a href="?url=admin/products/create" class="btn btn-light">
                    <i class="fas fa-plus-circle"></i> Novo Produto
                </a>
            </div>
        </div>
    </div>
</div>

<div class="container">
    <div class="card border-0 shadow-sm">
        <div class="card-body">
            <?php if (empty($products)): ?>
                <div class="text-center py-5">
                    <i class="fas fa-box fa-3x text-muted mb-3"></i>
                    <p class="h5 text-muted">Nenhum produto cadastrado</p>
                    <a href="?url=admin/products/create" class="btn btn-primary mt-3">
                        Cadastrar Primeiro Produto
                    </a>
                </div>
            <?php else: ?>
                <div class="table-responsive">
                    <table class="table table-hover align-middle mb-0">
                        <thead class="bg-light">
                            <tr>
                                <th class="border-0">ID</th>
                                <th class="border-0">Nome</th>
                                <th class="border-0">Descrição</th>
                                <th class="border-0">Preço</th>
                                <th class="border-0 text-end">Ações</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($products as $product): ?>
                                <tr>
                                    <td class="fw-bold"><?= $product['id'] ?></td>
                                    <td><?= htmlspecialchars($product['name']) ?></td>
                                    <td>
                                        <span class="text-muted text-truncate d-inline-block" style="max-width: 300px;">
                                            <?= htmlspecialchars($product['description']) ?>
                                        </span>
                                    </td>
                                    <td>
                                        <span class="badge bg-success">
                                            R$ <?= number_format($product['price'], 2, ',', '.') ?>
                                        </span>
                                    </td>
                                    <td class="text-end">
                                        <a href="?url=admin/products/edit/<?= $product['id'] ?>" 
                                           class="btn btn-sm btn-outline-primary me-1">
                                            <i class="fas fa-edit"></i> Editar
                                        </a>
                                        <button type="button" class="btn btn-sm btn-outline-danger"
                                                onclick="if(confirm('Tem certeza que deseja excluir este produto?')) 
                                                        window.location.href='?url=admin/products/delete/<?= $product['id'] ?>'">
                                            <i class="fas fa-trash"></i> Excluir
                                        </button>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            <?php endif; ?>
        </div>
    </div>
</div>

<?php
$content = ob_get_clean();
require_once __DIR__ . '/../../layouts/base.php';
?>
</html>
