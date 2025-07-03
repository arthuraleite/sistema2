<?php // app/Views/layout.php ?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title><?= $title ?? 'Sistema' ?></title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>
<body<?= isset($bodyAttributes) ? ' ' . $bodyAttributes : '' ?>>
<nav class="navbar navbar-expand-lg navbar-light bg-light mb-4">
    <div class="container-fluid">
        <a class="navbar-brand" href="<?= BASE_URL ?>">Sistema</a>
        <div class="collapse navbar-collapse">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <li class="nav-item"><a class="nav-link" href="<?= BASE_URL ?>/clientes">Clientes</a></li>
                <li class="nav-item"><a class="nav-link" href="<?= BASE_URL ?>/produtos">Produtos</a></li>
                <li class="nav-item"><a class="nav-link" href="<?= BASE_URL ?>/pedidos">Pedidos</a></li>
                <li class="nav-item"><a class="nav-link" href="<?= BASE_URL ?>/orcamentos">Orcamentos</a></li>
                <li class="nav-item"><a class="nav-link" href="<?= BASE_URL ?>/financeiro">Financeiro</a></li>
                <li class="nav-item"><a class="nav-link" href="<?= BASE_URL ?>/usuarios">Usuários</a></li>
            </ul>
        </div>
    </div>
</nav>
<?php echo $content ?? ''; ?>
</body>
</html>
