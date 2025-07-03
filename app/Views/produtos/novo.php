<?php $title = 'Novo Produto'; ob_start(); ?>
<div class="container mt-4">
    <h2>Novo Produto</h2>
    <form method="post" action="<?= BASE_URL ?>/produtos/salvar">
        <div class="mb-3">
            <label>Descrição</label>
            <input type="text" name="descricao" class="form-control" required>
        </div>
        <div class="mb-3">
            <label>Valor Unitário</label>
            <input type="number" step="0.01" name="valor_unitario" class="form-control" required>
        </div>
        <button type="submit" class="btn btn-success">Salvar</button>
    </form>
</div>
<?php $content = ob_get_clean(); include __DIR__ . '/../layout.php'; ?>
