<?php $title = 'Produtos'; ob_start(); ?>
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
                    <td><?= $p['descricao'] ?></td>
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
<?php $content = ob_get_clean(); include __DIR__ . '/../layout.php'; ?>
