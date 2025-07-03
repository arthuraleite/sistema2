<?php $title = 'Editar Pedido'; ?>
<script>
function addItem(desc = '', qtd = 1, val = 0) {
    const tbody = document.getElementById('itens');
    const row = document.createElement('tr');
    row.innerHTML = `
        <td><input name="itens[][descricao]" class="form-control" value="${desc}" required></td>
        <td><input type="number" name="itens[][quantidade]" class="form-control" value="${qtd}" onchange="calcTotal()" required></td>
        <td><input type="number" step="0.01" name="itens[][valor_unitario]" class="form-control" value="${val}" onchange="calcTotal()" required></td>
        <td><input type="number" step="0.01" name="itens[][subtotal]" class="form-control subtotal" readonly></td>
        <td><button type="button" class="btn btn-sm btn-danger" onclick="this.closest('tr').remove();calcTotal()">X</button></td>`;
    tbody.appendChild(row);
    calcTotal();
}
function addPagamento(valor = '', desc = '', data = '', forma = '') {
    const tbody = document.getElementById('pagamentos');
    const row = document.createElement('tr');
    row.innerHTML = `
        <td><input type="number" step="0.01" name="pagamentos[][valor]" class="form-control" value="${valor}" required></td>
        <td><input type="text" name="pagamentos[][descricao]" class="form-control" value="${desc}"></td>
        <td><input type="date" name="pagamentos[][data]" class="form-control" value="${data}" required></td>
        <td><input type="text" name="pagamentos[][forma_pagamento]" class="form-control" value="${forma}" required></td>
        <td><button type="button" onclick="this.closest('tr').remove()" class="btn btn-sm btn-danger">X</button></td>`;
    tbody.appendChild(row);
}
function calcTotal() {
    let total = 0;
    document.querySelectorAll('#itens tr').forEach(row => {
        const qtd = parseFloat(row.querySelector('input[name$="[quantidade]"]').value) || 0;
        const val = parseFloat(row.querySelector('input[name$="[valor_unitario]"]').value) || 0;
        const sub = qtd * val;
        row.querySelector('input[name$="[subtotal]"]').value = sub.toFixed(2);
        total += sub;
    });
    document.getElementById('total').value = total.toFixed(2);
}
</script>
<?php $title = 'Editar Pedido'; $bodyAttributes = 'onload="calcTotal()"'; ob_start(); ?>
<script>
        function calcTotal() {
            let total = 0;
            document.querySelectorAll('.subtotal').forEach(input => {
                const row = input.closest('tr');
                const qtd = parseFloat(row.querySelector('.qtd').value) || 0;
                const val = parseFloat(row.querySelector('.valor').value) || 0;
                const sub = qtd * val;
                input.value = sub.toFixed(2);
                total += sub;
            });
            document.getElementById('total').value = total.toFixed(2);
        }

        function addItem(desc = '', qtd = 1, valor = 0) {
            const tbody = document.getElementById('itens');
            const tr = document.createElement('tr');
            tr.innerHTML = `
                <td><input name="itens[][descricao]" class="form-control" value="${desc}" required></td>
                <td><input type="number" name="itens[][quantidade]" class="form-control qtd" value="${qtd}" onchange="calcTotal()" required></td>
                <td><input type="number" step="0.01" name="itens[][valor_unitario]" class="form-control valor" value="${valor}" onchange="calcTotal()" required></td>
                <td><input type="number" step="0.01" name="itens[][subtotal]" class="form-control subtotal" readonly></td>
                <td><button type="button" onclick="this.closest('tr').remove();calcTotal()" class="btn btn-sm btn-danger">X</button></td>
            `;
            tbody.appendChild(tr);
            calcTotal();
        }

        function addPagamento(valor = 0, descricao = '', data = '', forma = '') {
            const tbody = document.getElementById('pagamentos');
            const tr = document.createElement('tr');
            tr.innerHTML = `
                <td><input type="number" step="0.01" name="pagamentos[][valor]" class="form-control" value="${valor}" required></td>
                <td><input type="text" name="pagamentos[][descricao]" class="form-control" value="${descricao}"></td>
                <td><input type="date" name="pagamentos[][data]" class="form-control" value="${data}" required></td>
                <td><input type="text" name="pagamentos[][forma_pagamento]" class="form-control" value="${forma}" required></td>
                <td><button type="button" onclick="this.closest('tr').remove()" class="btn btn-sm btn-danger">X</button></td>
            `;
            tbody.appendChild(tr);
        }
    </script>
<div class="container mt-4">
    <h2>Editar Pedido</h2>
    <form method="post" action="<?= BASE_URL ?>/pedidos/atualizar/<?= $pedido['id'] ?>">
        <div class="row">
            <div class="mb-3 col-md-6">
                <label>Cliente</label>
                <select name="cliente_id" class="form-control" required>
                    <?php foreach ($clientes as $c): ?>
                        <option value="<?= $c['id'] ?>" <?= $c['id'] == $pedido['cliente_id'] ? 'selected' : '' ?>><?= $c['nome'] ?></option>
                    <?php endforeach; ?>
                </select>
            </div>
            <div class="mb-3 col-md-6">
                <label>Status</label>
                <select name="status" class="form-control">
                    <?php foreach (['Em Andamento','Pronto','Entregue'] as $s): ?>
                        <option <?= $pedido['status']==$s?'selected':'' ?>><?= $s ?></option>
                    <?php endforeach; ?>
                </select>
                        <option value="<?= $c['id'] ?>" <?= $c['id'] == $pedido['cliente_id'] ? 'selected' : '' ?>>
                            <?= htmlspecialchars($c['nome']) ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </div>
            <div class="mb-3 col-md-3">
                <label>Data do Pedido</label>
                <input type="date" name="data_pedido" class="form-control" value="<?= htmlspecialchars($pedido['data_pedido']) ?>" required>
            </div>
            <div class="mb-3 col-md-3">
                <label>Previsão de Entrega</label>
                <input type="date" name="previsao_entrega" class="form-control" value="<?= htmlspecialchars($pedido['previsao_entrega']) ?>" required>
            </div>
        </div>
        <h5>Itens</h5>
        <table class="table">
            <thead>
                <tr>
                    <th>Descrição</th>
                    <th>Quantidade</th>
                    <th>Valor Unitário</th>
                    <th>Subtotal</th>
                    <th></th>
                </tr>
            </thead>
            <tbody id="itens"></tbody>
        </table>
        <button type="button" class="btn btn-sm btn-secondary" onclick="addItem()">Adicionar Item</button>
        <div class="mt-3">
            <label>Total</label>
            <input type="number" step="0.01" id="total" name="total" class="form-control" value="<?= $pedido['total'] ?>" readonly>
        </div>
        <h5 class="mt-4">Pagamentos</h5>
        <table class="table">
            <thead>
                <tr>
                    <th>Valor</th>
                    <th>Descrição</th>
                    <th>Data</th>
                    <th>Forma de Pagamento</th>
                    <th></th>
                </tr>
            </thead>
            <tbody id="pagamentos"></tbody>
        </table>
        <button type="button" class="btn btn-sm btn-secondary" onclick="addPagamento()">Adicionar Pagamento</button>
        <div class="mt-3">
            <label>Observações</label>
            <textarea name="observacoes" class="form-control"><?= htmlspecialchars($pedido['observacoes']) ?></textarea>
        </div>
        <button type="submit" class="btn btn-success mt-3">Salvar Pedido</button>
    </form>
</div>
<script>
<?php foreach ($itens as $i): ?>
    addItem("<?= addslashes($i['descricao']) ?>", <?= $i['quantidade'] ?>, <?= $i['valor_unitario'] ?>);
<?php endforeach; ?>
<?php foreach ($movs as $m): ?>
    addPagamento(<?= $m['valor'] ?>, "<?= addslashes($m['descricao']) ?>", "<?= $m['data'] ?>", "<?= addslashes($m['forma_pagamento']) ?>");
<?php endforeach; ?>
</script>
<?php $content = ob_get_clean(); include __DIR__ . '/../layout.php'; ?>
