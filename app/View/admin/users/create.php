<?php
$title = 'Novo Usuário - Admin';
ob_start();

$old = $_SESSION['old'] ?? [];
?>

<!-- Admin Header -->
<div class="admin-header mb-4">
    <div class="container py-4">
        <div class="row align-items-center">
            <div class="col">
                <h1 class="h2 mb-0 text-dark">Cadastrar Novo Usuário</h1>
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
                    <form action="?url=admin/users/store" method="POST" class="needs-validation" novalidate>
                        <div class="mb-4">
                            <label for="name" class="form-label">Nome</label>
                            <div class="input-group">
                                <span class="input-group-text">
                                    <i class="fas fa-user"></i>
                                </span>
                                <input type="text" class="form-control form-control-lg" id="name" name="name" required
                                       value="<?= htmlspecialchars($old['name'] ?? '') ?>">
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
                                       value="<?= htmlspecialchars($old['email'] ?? '') ?>">
                                <div class="invalid-feedback">
                                    Por favor, informe um e-mail válido.
                                </div>
                            </div>
                        </div>

                        <div class="mb-4">
                            <label for="password" class="form-label">Senha</label>
                            <div class="input-group">
                                <span class="input-group-text">
                                    <i class="fas fa-lock"></i>
                                </span>
                                <input type="password" class="form-control form-control-lg" id="password" 
                                       name="password" required minlength="6">
                                <div class="invalid-feedback">
                                    A senha deve ter pelo menos 6 caracteres.
                                </div>
                            </div>
                            <div class="form-text">Use pelo menos 6 caracteres.</div>
                        </div>

                        <div class="mb-4">
                            <label for="password_confirm" class="form-label">Confirmar Senha</label>
                            <div class="input-group">
                                <span class="input-group-text">
                                    <i class="fas fa-lock"></i>
                                </span>
                                <input type="password" class="form-control form-control-lg" id="password_confirm"
                                       name="password_confirm" required minlength="6">
                                <div class="invalid-feedback">
                                    As senhas devem coincidir.
                                </div>
                            </div>
                        </div>

                        <hr class="my-4">

                        <div class="d-grid gap-2">
                            <button type="submit" class="btn btn-primary btn-lg">
                                <i class="fas fa-user-plus me-2"></i>Cadastrar Usuário
                            </button>
                            <a href="?url=admin/users" class="btn btn-outline-secondary">
                                Cancelar
                            </a>
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