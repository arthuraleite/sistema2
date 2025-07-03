<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Pedido</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container mt-4">
    <h2>Visualizar Pedido</h2>
    <p><strong>Cliente:</strong> <?= $pedido['cliente_nome'] ?></p>
    <p><strong>Status:</strong> <?= $pedido['status'] ?></p>
    <p><strong>Data:</strong> <?= date('d/m/Y', strtotime($pedido['data_pedido'])) ?></p>
    <p><strong>Entrega Prevista:</strong> <?= date('d/m/Y', strtotime($pedido['previsao_entrega'])) ?></p>
    <p><strong>Observações:</strong> <?= $pedido['observacoes'] ?></p>

    <h5>Itens</h5>
    <table class="table table-bordered">
        <thead><tr><th>Descrição</th><th>Qtd</th><th>Unitário</th><th>Subtotal</th></tr></thead>
        <tbody>
            <?php foreach ($itens as $item): ?>
                <tr>
                    <td><?= $item['descricao'] ?></td>
                    <td><?= $item['quantidade'] ?></td>
                    <td>R$ <?= number_format($item['valor_unitario'], 2, ',', '.') ?></td>
                    <td>R$ <?= number_format($item['subtotal'], 2, ',', '.') ?></td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>

    <h5>Pagamentos</h5>
    <table class="table table-bordered">
        <thead><tr><th>Valor</th><th>Descrição</th><th>Data</th><th>Forma</th></tr></thead>
        <tbody>
            <?php
            $totalPago = 0;
            foreach ($movs as $m):
                $totalPago += $m['valor'];
            ?>
                <tr>
                    <td>R$ <?= number_format($m['valor'], 2, ',', '.') ?></td>
                    <td><?= $m['descricao'] ?></td>
                    <td><?= date('d/m/Y', strtotime($m['data'])) ?></td>
                    <td><?= $m['forma_pagamento'] ?></td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>

    <div class="alert <?= $totalPago == $pedido['total'] ? 'alert-success' : 'alert-warning' ?>">
        Total do Pedido: R$ <?= number_format($pedido['total'], 2, ',', '.') ?> <br>
        Total Recebido: R$ <?= number_format($totalPago, 2, ',', '.') ?>
    </div>
</div>
</body>
</html>
