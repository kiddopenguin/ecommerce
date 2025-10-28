<?php
$title = 'Detalhes do Usuário - Admin';
ob_start();
?>

<!-- Admin Header -->
<div class="admin-header mb-4">
    <div class="container py-4">
        <div class="row align-items-center">
            <div class="col">
                <h1 class="h2 mb-0 text-dark">
                    Detalhes do Usuário
                </h1>
            </div>
            <div class="col-auto">
                <a href="?url=admin/users" class="btn btn-light">
                    <i class="fas fa-arrow-left"></i> Voltar
                </a>
            </div>
        </div>
    </div>
</div>

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card border-0 shadow-sm">
                <div class="card-body p-4">
                    <div class="text-center mb-4">
                        <div class="avatar-placeholder mb-3">
                            <i class="fas fa-user-circle fa-4x text-primary"></i>
                        </div>
                        <h3 class="h4 mb-1"><?= htmlspecialchars($user['name']) ?></h3>
                        <p class="text-muted mb-0">
                            <i class="fas fa-envelope me-2"></i><?= htmlspecialchars($user['email']) ?>
                        </p>
                    </div>

                    <hr class="my-4">

                    <div class="row g-4">
                        <div class="col-md-6">
                            <div class="user-detail">
                                <label class="text-muted mb-1">ID do Usuário</label>
                                <p class="h6 mb-0">#<?= htmlspecialchars($user['id']) ?></p>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="user-detail">
                                <label class="text-muted mb-1">Status</label>
                                <p class="h6 mb-0">
                                    <span class="badge bg-success">
                                        <i class="fas fa-check-circle me-1"></i>Ativo
                                    </span>
                                </p>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="user-detail">
                                <label class="text-muted mb-1">Data de Criação</label>
                                <p class="h6 mb-0">
                                    <i class="fas fa-calendar me-2"></i>
                                    <?= date('d/m/Y H:i', strtotime($user['created_at'])) ?>
                                </p>
                            </div>
                        </div>
                        <?php if (isset($user['updated_at']) && !empty($user['updated_at'])): ?>
                        <div class="col-md-6">
                            <div class="user-detail">
                                <label class="text-muted mb-1">Última Atualização</label>
                                <p class="h6 mb-0">
                                    <i class="fas fa-clock me-2"></i>
                                    <?= date('d/m/Y H:i', strtotime($user['updated_at'])) ?>
                                </p>
                            </div>
                        </div>
                        <?php endif; ?>
                    </div>

                    <hr class="my-4">

                    <div class="d-flex justify-content-between">
                        <a href="?url=admin/users/edit/<?= $user['id'] ?>" class="btn btn-primary">
                            <i class="fas fa-edit me-2"></i>Editar Usuário
                        </a>
                        <form action="?url=admin/users/delete/<?= $user['id'] ?>" method="POST" class="d-inline"
                              onsubmit="return confirm('Tem certeza que deseja excluir este usuário? Esta ação não pode ser desfeita.');">
                            <button type="submit" class="btn btn-danger">
                                <i class="fas fa-trash-alt me-2"></i>Excluir Usuário
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php
$content = ob_get_clean();
require_once __DIR__ . '/../../layouts/base.php';
?>