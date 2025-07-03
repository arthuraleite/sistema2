<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Confirmação</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container mt-4">
    <div class="alert alert-success"><?php echo $mensagem; ?></div>
    <a href="<?php echo htmlspecialchars($voltar); ?>" class="btn btn-primary">Voltar</a>
</div>
</body>
</html>
