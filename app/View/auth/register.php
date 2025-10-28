<?php
$title = 'Cadastro - E-commerce';
ob_start();

$old = $_SESSION['old'] ?? [];
?>

<div class="row justify-content-center">
    <div class="col-md-6 col-lg-5">
        <div class="card shadow-sm">
            <div class="card-body p-4">
                <h2 class="card-title text-center mb-4">Criar Conta</h2>
                
                <form action="?url=register" method="POST" novalidate>
                    <div class="mb-3">
                        <label for="name" class="form-label">Nome</label>
                        <input type="text" class="form-control" id="name" name="name" required 
                               value="<?= htmlspecialchars($old['name'] ?? '') ?>">
                    </div>

                    <div class="mb-3">
                        <label for="email" class="form-label">E-mail</label>
                        <input type="email" class="form-control" id="email" name="email" required 
                               value="<?= htmlspecialchars($old['email'] ?? '') ?>">
                    </div>

                    <div class="mb-3">
                        <label for="password" class="form-label">Senha</label>
                        <input type="password" class="form-control" id="password" name="password" 
                               required minlength="6">
                        <div class="form-text">A senha deve ter pelo menos 6 caracteres</div>
                    </div>

                    <div class="mb-3">
                        <label for="password_confirm" class="form-label">Confirmar Senha</label>
                        <input type="password" class="form-control" id="password_confirm" 
                               name="password_confirm" required minlength="6">
                    </div>

                    <div class="d-grid gap-2">
                        <button type="submit" class="btn btn-primary btn-lg">Cadastrar</button>
                    </div>
                </form>

                <div class="text-center mt-4">
                    <p class="mb-0">Já tem uma conta? 
                        <a href="?url=auth/login" class="text-primary text-decoration-none">Fazer login</a>
                    </p>
                </div>
            </div>
        </div>
    </div>
</div>

<?php
$content = ob_get_clean();
require_once __DIR__ . '/../layouts/base.php';
?>