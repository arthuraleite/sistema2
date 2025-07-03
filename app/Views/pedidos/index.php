<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Pedidos</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container mt-4">
    <h2>Pedidos</h2>
    <a href="<?= BASE_URL ?>/pedidos/novo" class="btn btn-primary mb-3">Novo Pedido</a>

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Cliente</th>
                <th>Status</th>
                <th>Valor Total</th>
                <th>Ações</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($pedidos as $p): ?>
                <tr>
                    <td><?= htmlspecialchars($p['cliente_nome']) ?></td>
                    <td><?= htmlspecialchars($p['status']) ?></td>
                    <td>R$ <?= number_format($p['total'], 2, ',', '.') ?></td>
                    <td>
                        <a href="<?= BASE_URL ?>/pedidos/ver/<?= $p['id'] ?>" class="btn btn-sm btn-info">Visualizar</a>
                        <a href="<?= BASE_URL ?>/pedidos/excluir/<?= $p['id'] ?>" onclick="return confirm('Deseja excluir este pedido?')" class="btn btn-sm btn-danger">Excluir</a>
                    </td>
                </tr>
            <?php endforeach ?>
        </tbody>
    </table>
</div>
</body>
</html>
