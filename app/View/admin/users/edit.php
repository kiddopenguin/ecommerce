<?php
$title = 'Editar Usuário - Admin';
ob_start();

$old = $_SESSION['old'] ?? [];
?>

<!-- Admin Header -->
<div class="admin-header mb-4">
    <div class="container py-4">
        <div class="row align-items-center">
            <div class="col">
                <h1 class="h2 mb-0 text-dark">
                    Editar Usuário: <?= htmlspecialchars($user['name']) ?>
                </h1>
            </div>
            <!-- botão voltar removido conforme solicitado -->
        </div>
    </div>
</div>

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card border-0 shadow-sm">
                <div class="card-body p-4">
                    <form action="?url=admin/users/update/<?= $user['id'] ?>" method="POST" class="needs-validation" novalidate>
                        <div class="mb-4">
                            <label for="name" class="form-label">Nome</label>
                            <div class="input-group">
                                <span class="input-group-text">
                                    <i class="fas fa-user"></i>
                                </span>
                                <input type="text" class="form-control form-control-lg" id="name" name="name" required
                                       value="<?= htmlspecialchars($old['name'] ?? $user['name']) ?>">
                                <div class="invalid-feedback">
                                    Por favor, informe o nome do usuário.
                                </div>
                            </div>
                        </div>

                        <div class="mb-4">
                            <label for="email" class="form-label">E-mail</label>
                            <div class="input-group">
                                <span class="input-group-text">
                                    <i class="fas fa-envelope"></i>
                                </span>
                                <input type="email" class="form-control form-control-lg" id="email" name="email" required
                                       value="<?= htmlspecialchars($old['email'] ?? $user['email']) ?>">
                                <div class="invalid-feedback">
                                    Por favor, informe um e-mail válido.
                                </div>
                            </div>
                        </div>

                        <div class="mb-4">
                            <label for="password" class="form-label">Nova Senha (opcional)</label>
                            <div class="input-group">
                                <span class="input-group-text">
                                    <i class="fas fa-lock"></i>
                                </span>
                                <input type="password" class="form-control form-control-lg" id="password" 
                                       name="password" minlength="6">
                                <div class="invalid-feedback">
                                    A senha deve ter pelo menos 6 caracteres.
                                </div>
                            </div>
                            <div class="form-text">Deixe em branco para manter a senha atual.</div>
                        </div>

                        <div class="mb-4">
                            <label for="password_confirm" class="form-label">Confirmar Nova Senha</label>
                            <div class="input-group">
                                <span class="input-group-text">
                                    <i class="fas fa-lock"></i>
                                </span>
                                <input type="password" class="form-control form-control-lg" id="password_confirm"
                                       name="password_confirm" minlength="6">
                                <div class="invalid-feedback">
                                    As senhas devem coincidir.
                                </div>
                            </div>
                        </div>

                        <hr class="my-4">

                        <div class="d-flex justify-content-between">
                            <a href="?url=admin/users" class="btn btn-outline-secondary">
                                Cancelar
                            </a>
                            <button type="submit" class="btn btn-primary">
                                <i class="fas fa-save me-2"></i>Salvar Alterações
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Form validation script -->
<script>
(function () {
    'use strict'
    var forms = document.querySelectorAll('.needs-validation')
    Array.prototype.slice.call(forms).forEach(function (form) {
        form.addEventListener('submit', function (event) {
            if (!form.checkValidity()) {
                event.preventDefault()
                event.stopPropagation()
            }
            form.classList.add('was-validated')
        }, false)
    })
})()
</script>

<?php
$content = ob_get_clean();
require_once __DIR__ . '/../../layouts/base.php';
?>

        <div class="text-center mt-3">
            <a href="?url=admin/users" class="text-decoration-none">← Voltar à lista</a>
        </div>
    </div>
</body>

</html>