<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Editar Produto</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container mt-4">
    <h2>Editar Produto</h2>
    <form method="post" action="<?= BASE_URL ?>/produtos/atualizar/<?= $produto['id'] ?>">
        <div class="mb-3">
            <label>Descrição</label>
            <input type="text" name="descricao" class="form-control" value="<?= $produto['descricao'] ?>" required>
        </div>
        <div class="mb-3">
            <label>Valor Unitário</label>
            <input type="number" step="0.01" name="valor_unitario" class="form-control" value="<?= $produto['valor_unitario'] ?>" required>
        </div>
        <button type="submit" class="btn btn-primary">Atualizar</button>
    </form>
</div>
</body>
</html>
