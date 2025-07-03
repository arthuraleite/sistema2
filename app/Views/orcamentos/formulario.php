<?php $title = 'Orçamento'; ?>
<script>
function addItem(desc = '', qtd = 1, val = 0) {
    const tr = document.createElement('tr');
    tr.innerHTML = `
        <td><input name="itens[][descricao]" class="form-control" value="${desc}" required></td>
        <td><input type="number" name="itens[][quantidade]" class="form-control qtd" value="${qtd}" onchange="calc()" required></td>
        <td><input type="number" step="0.01" name="itens[][valor_unitario]" class="form-control val" value="${val}" onchange="calc()" required></td>
        <td><input type="number" step="0.01" name="itens[][subtotal]" class="form-control subtotal" readonly></td>
        <td><button type="button" class="btn btn-sm btn-danger" onclick="this.closest('tr').remove();calc()">X</button></td>`;
    document.getElementById('itens').appendChild(tr);
    calc();
}
function calc() {
    let total = 0;
    document.querySelectorAll('#itens tr').forEach(tr => {
        const qtd = parseFloat(tr.querySelector('.qtd').value) || 0;
        const val = parseFloat(tr.querySelector('.val').value) || 0;
        const sub = qtd * val;
        tr.querySelector('.subtotal').value = sub.toFixed(2);
        total += sub;
    });
    document.getElementById('total').value = total.toFixed(2);
}
</script>
<div class="container mt-4">
    <h2>Orçamento</h2>
    <form method="post" action="<?= $action ?>">
        <div class="row mb-3">
            <div class="col-md-6">
                <label>Cliente</label>
                <select name="cliente_id" class="form-control" required>
                    <option value="">Selecione</option>
                    <?php foreach ($clientes as $c): ?>
                        <option value="<?= $c['id'] ?>" <?= isset($orcamento['cliente_id']) && $orcamento['cliente_id']==$c['id'] ? 'selected' : '' ?>><?= $c['nome'] ?></option>
                    <?php endforeach; ?>
                </select>
            </div>
            <div class="col-md-6">
                <label>Contato</label>
                <input name="cliente_contato" class="form-control" value="<?= $orcamento['cliente_contato'] ?? '' ?>">
            </div>
        </div>
        <div class="row mb-3">
            <div class="col-md-6">
                <label>Data</label>
                <input type="date" name="data" class="form-control" value="<?= $orcamento['data'] ?? date('Y-m-d') ?>">
            </div>
            <div class="col-md-6">
                <label>Validade</label>
                <input type="date" name="validade" class="form-control" value="<?= $orcamento['validade'] ?? date('Y-m-d', strtotime('+7 days')) ?>">
            </div>
        </div>
        <h5>Itens</h5>
        <table class="table">
            <thead>
                <tr>
                    <th>Descrição</th>
                    <th>Qtd</th>
                    <th>Valor Unit.</th>
                    <th>Subtotal</th>
                    <th></th>
                </tr>
            </thead>
            <tbody id="itens"></tbody>
        </table>
        <button type="button" class="btn btn-sm btn-secondary" onclick="addItem()">Adicionar Item</button>
        <div class="mt-3">
            <label>Total</label>
            <input type="number" step="0.01" name="total" id="total" class="form-control" value="<?= $orcamento['total'] ?? 0 ?>" readonly>
        </div>
        <div class="mb-3 mt-3">
            <label>Observações</label>
            <textarea name="observacoes" class="form-control"><?= $orcamento['observacoes'] ?? '' ?></textarea>
        </div>
        <button class="btn btn-success">Salvar</button>
    </form>
</div>
