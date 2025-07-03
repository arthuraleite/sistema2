<?php $title = 'Visualizar Orçamento'; ob_start(); ?>
<div class="container mt-4">
    <h2>Visualizar Orçamento</h2>
    <p><strong>Cliente:</strong> <?= htmlspecialchars($orcamento['cliente_nome']) ?></p>
    <p><strong>Contato:</strong> <?= htmlspecialchars($orcamento['cliente_contato']) ?></p>
    <p><strong>Data:</strong> <?= date('d/m/Y', strtotime($orcamento['data'])) ?></p>
    <p><strong>Validade:</strong> <?= date('d/m/Y', strtotime($orcamento['validade'])) ?></p>

    <table class="table table-bordered">
        <thead><tr><th>Descrição</th><th>Qtd</th><th>Unitário</th><th>Subtotal</th></tr></thead>
        <tbody>
            <?php foreach ($itens as $i): ?>
                <tr>
                    <td><?= htmlspecialchars($i['descricao']) ?></td>
                    <td><?= $i['quantidade'] ?></td>
                    <td>R$ <?= number_format($i['valor_unitario'], 2, ',', '.') ?></td>
                    <td>R$ <?= number_format($i['subtotal'], 2, ',', '.') ?></td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>

    <div class="alert alert-info">
        Total: <strong>R$ <?= number_format($orcamento['total'], 2, ',', '.') ?></strong>
    </div>
    <p><strong>Observações:</strong><br><?= nl2br(htmlspecialchars($orcamento['observacoes'])) ?></p>
  </div>
<?php $content = ob_get_clean(); include __DIR__ . '/../layout.php'; ?>
