<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <title>Detalhes do Usuário</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f0f4f8;
        }

        .details-card {
            max-width: 600px;
            margin: 5% auto;
            background: #fff;
            border-radius: 10px;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.08);
            padding: 2rem;
        }

        .details-title {
            color: #0d6efd;
            font-weight: bold;
            text-align: center;
            margin-bottom: 1.5rem;
        }

        .details-label {
            font-weight: bold;
            color: #333;
        }
    </style>
</head>

<body>
    <div class="details-card">
        <h3 class="details-title">Detalhes do Usuário</h3>

        <div class="mb-3">
            <span class="details-label">ID:</span>
            <p><?= htmlspecialchars($user['id']) ?></p>
        </div>

        <div class="mb-3">
            <span class="details-label">Nome:</span>
            <p><?= htmlspecialchars($user['name']) ?></p>
        </div>

        <div class="mb-3">
            <span class="details-label">E-mail:</span>
            <p><?= htmlspecialchars($user['email']) ?></p>
        </div>

        <div class="mb-3">
            <span class="details-label">Criado em:</span>
            <p><?= date('d/m/Y H:i', strtotime($user['created_at'])) ?></p>
        </div>

        <?php if (!empty($user['updated_at'])): ?>
            <div class="mb-3">
                <span class="details-label">Atualizado em:</span>
                <p><?= date('d/m/Y H:i', strtotime($user['updated_at'])) ?></p>
            </div>
        <?php endif; ?>

        <div class="d-flex justify-content-between">
            <a href="?url=admin/users/edit/<?= $user['id'] ?>" class="btn btn-outline-warning">Editar</a>
            <a href="?url=admin/users" class="btn btn-outline-secondary">Voltar</a>
        </div>
    </div>
</body>

</html>