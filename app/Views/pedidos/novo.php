<?php $title = 'Novo Pedido'; ob_start(); ?>
<script>
        function addItem() {
            const tbody = document.getElementById('itens');
            const row = document.createElement('tr');
            row.innerHTML = `
                <td><input name="itens[][descricao]" class="form-control" required></td>
                <td><input type="number" name="itens[][quantidade]" class="form-control" value="1" min="1" onchange="calcTotal()" required></td>
                <td><input type="number" step="0.01" name="itens[][valor_unitario]" class="form-control" onchange="calcTotal()" required></td>
                <td><input type="number" step="0.01" name="itens[][subtotal]" class="form-control subtotal" readonly></td>
                <td><button type="button" onclick="this.closest('tr').remove(); calcTotal()" class="btn btn-sm btn-danger">X</button></td>
            `;
            tbody.appendChild(row);
        }

        function addPagamento() {
            const tbody = document.getElementById('pagamentos');
            const row = document.createElement('tr');
            row.innerHTML = `
                <td><input type="number" step="0.01" name="pagamentos[][valor]" class="form-control" required></td>
                <td><input type="text" name="pagamentos[][descricao]" class="form-control"></td>
                <td><input type="date" name="pagamentos[][data]" class="form-control" required></td>
                <td><input type="text" name="pagamentos[][forma_pagamento]" class="form-control" required></td>
                <td><button type="button" onclick="this.closest('tr').remove()" class="btn btn-sm btn-danger">X</button></td>
            `;
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
<div class="container mt-4">
    <h2>Novo Pedido</h2>
    <form method="post" action="<?= BASE_URL ?>/pedidos/salvar">
        <div class="row">
            <div class="mb-3 col-md-6">
                <label>Cliente</label>
                <select name="cliente_id" class="form-control" required>
                    <option value="">Selecione</option>
                    <?php foreach ($clientes as $c): ?>
                        <option value="<?= $c['id'] ?>"><?= htmlspecialchars($c['nome']) ?></option>
                    <?php endforeach; ?>
                </select>
            </div>
            <div class="mb-3 col-md-3">
                <label>Data do Pedido</label>
                <input type="date" name="data_pedido" class="form-control" value="<?= date('Y-m-d') ?>" required>
            </div>
            <div class="mb-3 col-md-3">
                <label>Previsão Entrega</label>
                <input type="date" name="previsao_entrega" class="form-control" required>
            </div>
        </div>
        <div class="mb-3">
            <label>Status</label>
            <select name="status" class="form-control">
                <option>Aberto</option>
                <option>Em Andamento</option>
                <option>Pronto</option>
                <option>Concluído</option>
                <option>Entregue</option>
                <option>Liquidado</option>
                <option>Cancelado</option>
            </select>
        </div>

        <h5>Itens do Pedido</h5>
        <table class="table table-sm table-bordered">
            <thead>
                <tr>
                    <th>Descrição</th>
                    <th>Qtd</th>
                    <th>Valor Unitário</th>
                    <th>Subtotal</th>
                    <th></th>
                </tr>
            </thead>
            <tbody id="itens"></tbody>
        </table>
        <button type="button" onclick="addItem()" class="btn btn-sm btn-secondary">Adicionar Item</button>

        <div class="mt-3 mb-3">
            <label>Total</label>
            <input type="number" step="0.01" name="total" id="total" class="form-control" readonly required>
        </div>

        <h5>Pagamentos</h5>
        <table class="table table-sm table-bordered">
            <thead>
                <tr>
                    <th>Valor</th>
                    <th>Descrição</th>
                    <th>Data</th>
                    <th>Forma Pagamento</th>
                    <th></th>
                </tr>
            </thead>
            <tbody id="pagamentos"></tbody>
        </table>
        <button type="button" onclick="addPagamento()" class="btn btn-sm btn-secondary">Adicionar Pagamento</button>

        <div class="mt-3">
            <label>Observações</label>
            <textarea name="observacoes" class="form-control"></textarea>
        </div>
        <button type="submit" class="btn btn-success mt-3">Salvar Pedido</button>
    </form>
</div>
<?php $content = ob_get_clean(); include __DIR__ . '/../layout.php'; ?>
