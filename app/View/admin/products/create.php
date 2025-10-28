<?php
$title = 'Criar Produto - Admin';
ob_start();

$old = $_SESSION['old'] ?? [];
?>

<!-- Admin Header -->
<div class="admin-header mb-4">
    <div class="container py-4">
        <div class="row align-items-center">
            <div class="col">
                <h1 class="h2 mb-0 text-white">Criar Novo Produto</h1>
            </div>
            <div class="col-auto">
                <a href="?url=admin/products" class="btn btn-light">
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
                    <form action="?url=admin/products/store" method="POST" class="needs-validation" novalidate>
                        <div class="mb-4">
                            <label for="name" class="form-label">Nome do Produto</label>
                            <input type="text" class="form-control form-control-lg" id="name" name="name" required
                                   value="<?= htmlspecialchars($old['name'] ?? '') ?>">
                            <div class="invalid-feedback">
                                Por favor, informe o nome do produto.
                            </div>
                        </div>

                        <div class="mb-4">
                            <label for="description" class="form-label">Descrição</label>
                            <textarea class="form-control" id="description" name="description" rows="4"><?= htmlspecialchars($old['description'] ?? '') ?></textarea>
                        </div>

                        <div class="mb-4">
                            <label for="price" class="form-label">Preço</label>
                            <div class="input-group">
                                <span class="input-group-text">R$</span>
                                <input type="number" class="form-control" id="price" name="price" step="0.01" required
                                       value="<?= htmlspecialchars($old['price'] ?? '') ?>">
                                <div class="invalid-feedback">
                                    Por favor, informe um preço válido.
                                </div>
                            </div>
                        </div>

                        <hr class="my-4">

                        <div class="d-flex justify-content-end gap-2">
                            <a href="?url=admin/products" class="btn btn-outline-secondary">Cancelar</a>
                            <button type="submit" class="btn btn-primary">
                                <i class="fas fa-save"></i> Salvar Produto
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
