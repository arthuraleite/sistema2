<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Financeiro</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container mt-4">
    <h2>Despesas</h2>
    <a href="<?= BASE_URL ?>/financeiro/novo" class="btn btn-primary mb-3">Nova Despesa</a>

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Descrição</th>
                <th>Valor</th>
                <th>Data</th>
                <th>Ações</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($lancamentos as $l): ?>
                <tr>
                    <td><?= htmlspecialchars($l['descricao']) ?></td>
                    <td>R$ <?= number_format($l['valor'], 2, ',', '.') ?></td>
                    <td><?= date('d/m/Y', strtotime($l['data'])) ?></td>
                    <td>
                        <a href="<?= BASE_URL ?>/financeiro/editar/<?= $l['id'] ?>" class="btn btn-sm btn-warning">Editar</a>
                        <a href="<?= BASE_URL ?>/financeiro/excluir/<?= $l['id'] ?>" onclick="return confirm('Excluir esta despesa?')" class="btn btn-sm btn-danger">Excluir</a>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>
</body>
</html>
