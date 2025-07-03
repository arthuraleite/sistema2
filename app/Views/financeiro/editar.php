<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Editar Despesa</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container mt-4">
    <h2>Editar Despesa</h2>
    <form method="post" action="<?= BASE_URL ?>/financeiro/atualizar/<?= $lancamento['id'] ?>">
        <div class="mb-3">
            <label>Descrição</label>
            <input type="text" name="descricao" class="form-control" value="<?= htmlspecialchars($lancamento['descricao']) ?>" required>
        </div>
        <div class="mb-3">
            <label>Valor</label>
            <input type="number" step="0.01" name="valor" class="form-control" value="<?= $lancamento['valor'] ?>" required>
        </div>
        <div class="mb-3">
            <label>Data</label>
            <input type="date" name="data" class="form-control" value="<?= $lancamento['data'] ?>" required>
        </div>
        <button type="submit" class="btn btn-primary">Atualizar</button>
    </form>
</div>
</body>
</html>
