<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Usuários</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container mt-4">
    <h2>Usuários do Sistema</h2>
    <a href="<?= BASE_URL ?>/usuarios/novo" class="btn btn-success mb-3">Novo Usuário</a>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Usuário</th>
                <th>Tipo</th>
                <th>Ações</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($usuarios as $u): ?>
                <tr>
                    <td><?= htmlspecialchars($u['usuario']) ?></td>
                    <td><?= htmlspecialchars($u['tipo']) ?></td>
                    <td>
                        <a href="<?= BASE_URL ?>/usuarios/excluir/<?= $u['id'] ?>" onclick="return confirm('Excluir este usuário?')" class="btn btn-sm btn-danger">Excluir</a>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>
</body>
</html>
