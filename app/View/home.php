<?php
$title = 'E-commerce - Página Inicial';
ob_start();
?>

<!-- Hero Section -->
<div class="py-5 mb-4 bg-light rounded-3">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-md-6">
                <h1 class="display-5 fw-bold mb-3">Bem-vindo ao E-commerce</h1>
                <p class="fs-4 mb-4">Encontre os melhores produtos com os melhores preços.</p>
                <a href="#produtos" class="btn btn-primary btn-lg">Ver Produtos</a>
            </div>
            <div class="col-md-6 text-end">
                <img src="https://via.placeholder.com/600x400" alt="Hero Image" class="img-fluid rounded shadow">
            </div>
        </div>
    </div>
</div>

<!-- Featured Products -->
<section id="produtos" class="mb-5">
    <div class="container">
        <h2 class="mb-4">Produtos em Destaque</h2>
        
        <div class="row row-cols-1 row-cols-md-2 row-cols-lg-4 g-4">
            <?php for($i = 1; $i <= 4; $i++): ?>
            <div class="col">
                <div class="card h-100 border-0 shadow-sm">
                    <img src="https://via.placeholder.com/300x200" class="card-img-top" alt="Product <?= $i ?>">
                    <div class="card-body">
                        <h5 class="card-title">Produto <?= $i ?></h5>
                        <p class="card-text text-muted">Descrição breve do produto <?= $i ?>.</p>
                        <div class="d-flex justify-content-between align-items-center">
                            <span class="h5 mb-0">R$ <?= number_format(rand(99, 999), 2, ',', '.') ?></span>
                            <a href="#" class="btn btn-outline-primary">Ver Detalhes</a>
                        </div>
                    </div>
                </div>
            </div>
            <?php endfor; ?>
        </div>
    </div>
</section>

<!-- Categories -->
<section class="mb-5">
    <div class="container">
        <h2 class="mb-4">Categorias</h2>
        <div class="row g-4">
            <div class="col-md-4">
                <div class="card bg-primary text-white border-0">
                    <div class="card-body">
                        <h3 class="card-title">Eletrônicos</h3>
                        <p class="card-text">Smartphones, notebooks e mais</p>
                        <a href="#" class="btn btn-light">Explorar</a>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card bg-success text-white border-0">
                    <div class="card-body">
                        <h3 class="card-title">Moda</h3>
                        <p class="card-text">Roupas, calçados e acessórios</p>
                        <a href="#" class="btn btn-light">Explorar</a>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card bg-info text-white border-0">
                    <div class="card-body">
                        <h3 class="card-title">Casa</h3>
                        <p class="card-text">Móveis e decoração</p>
                        <a href="#" class="btn btn-light">Explorar</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Newsletter -->
<section class="bg-light py-5 rounded-3">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8 text-center">
                <h2 class="mb-3">Fique por dentro das novidades</h2>
                <p class="text-muted mb-4">Cadastre-se para receber ofertas exclusivas e novidades.</p>
                <form class="row g-3 justify-content-center">
                    <div class="col-8">
                        <input type="email" class="form-control form-control-lg" placeholder="Seu e-mail">
                    </div>
                    <div class="col-auto">
                        <button type="submit" class="btn btn-primary btn-lg">Cadastrar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</section>

<?php
$content = ob_get_clean();
require_once __DIR__ . '/layouts/base.php';
?>