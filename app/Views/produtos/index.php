<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Produtos</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container mt-4">
    <h2>Produtos</h2>
    <a href="<?= BASE_URL ?>/produtos/novo" class="btn btn-primary mb-3">Novo Produto</a>

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Descrição</th>
                <th>Valor Unitário</th>
                <th>Ações</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($produtos as $p): ?>
                <tr>
                    <td><?= htmlspecialchars($p['descricao']) ?></td>
                    <td>R$ <?= number_format($p['valor_unitario'], 2, ',', '.') ?></td>
                    <td>
                        <a href="<?= BASE_URL ?>/produtos/editar/<?= $p['id'] ?>" class="btn btn-sm btn-warning">Editar</a>
                        <a href="<?= BASE_URL ?>/produtos/excluir/<?= $p['id'] ?>" onclick="return confirm('Excluir este produto?')" class="btn btn-sm btn-danger">Excluir</a>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>
</body>
</html>
