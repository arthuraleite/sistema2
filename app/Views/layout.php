<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title><?= $title ?? 'Sistema'; ?></title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="<?= BASE_URL ?>/style.css" rel="stylesheet">
</head>
<body>
<nav class="navbar navbar-expand-lg navbar-light bg-light mb-4">
    <div class="container-fluid">
        <a class="navbar-brand" href="<?= BASE_URL ?>">Sistema</a>
        <div class="collapse navbar-collapse">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <li class="nav-item"><a class="nav-link" href="<?= BASE_URL ?>/clientes">Clientes</a></li>
                <li class="nav-item"><a class="nav-link" href="<?= BASE_URL ?>/produtos">Produtos</a></li>
                <li class="nav-item"><a class="nav-link" href="<?= BASE_URL ?>/pedidos">Pedidos</a></li>
                <li class="nav-item"><a class="nav-link" href="<?= BASE_URL ?>/orcamentos">Orçamentos</a></li>
                <li class="nav-item"><a class="nav-link" href="<?= BASE_URL ?>/financeiro">Financeiro</a></li>
                <li class="nav-item"><a class="nav-link" href="<?= BASE_URL ?>/usuarios">Usuários</a></li>
            </ul>
            <button id="themeToggle" class="btn btn-outline-secondary">Modo Escuro</button>
        </div>
    </div>
</nav>
<?= $content ?>
<script src="<?= BASE_URL ?>/theme.js"></script>
</body>
</html>
