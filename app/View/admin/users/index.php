<?php
$title = 'Gerenciar Usuários - Admin';
ob_start();
?>

<!-- Admin Header -->
<div class="admin-header mb-4">
    <div class="container py-4">
        <div class="row align-items-center">
            <div class="col">
                <h1 class="h2 mb-0 text-dark">Gerenciar Usuários</h1>
            </div>
            <div class="col-auto">
                <a href="?url=admin/users/create" class="btn btn-light">
                    <i class="fas fa-user-plus"></i> Novo Usuário
                </a>
            </div>
        </div>
    </div>
</div>

<div class="container">
    <div class="card border-0 shadow-sm">
        <div class="card-body">
            <?php if (empty($users)): ?>
                <div class="text-center py-5">
                    <i class="fas fa-users fa-3x text-muted mb-3"></i>
                    <p class="h5 text-muted">Nenhum usuário cadastrado</p>
                    <a href="?url=admin/users/create" class="btn btn-primary mt-3">
                        Cadastrar Primeiro Usuário
                    </a>
                </div>
            <?php else: ?>
                <div class="table-responsive">
                    <table class="table table-hover align-middle mb-0">
                        <thead class="bg-light">
                            <tr>
                                <th class="border-0">ID</th>
                                <th class="border-0">Nome</th>
                                <th class="border-0">E-mail</th>
                                <th class="border-0">Cadastrado em</th>
                                <th class="border-0 text-end">Ações</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($users as $user): ?>
                                <tr>
                                    <td class="fw-bold"><?= $user['id'] ?></td>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <i class="fas fa-user-circle fa-lg text-muted me-2"></i>
                                            <?= htmlspecialchars($user['name']) ?>
                                        </div>
                                    </td>
                                    <td>
                                        <a href="mailto:<?= htmlspecialchars($user['email']) ?>" 
                                           class="text-decoration-none">
                                            <?= htmlspecialchars($user['email']) ?>
                                        </a>
                                    </td>
                                    <td>
                                        <i class="far fa-calendar-alt text-muted me-1"></i>
                                        <?= date('d/m/Y H:i', strtotime($user['created_at'])) ?>
                                    </td>
                                    <td class="text-end">
                                        <a href="?url=admin/users/show/<?= $user['id'] ?>" 
                                           class="btn btn-sm btn-outline-secondary me-1">
                                            <i class="fas fa-eye"></i>
                                        </a>
                                        <a href="?url=admin/users/edit/<?= $user['id'] ?>" 
                                           class="btn btn-sm btn-outline-primary me-1">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                        <button type="button" class="btn btn-sm btn-outline-danger"
                                                onclick="if(confirm('Tem certeza que deseja excluir este usuário?')) 
                                                        window.location.href='?url=admin/users/delete/<?= $user['id'] ?>'">
                                            <i class="fas fa-trash"></i>
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