<?php $title = 'Orçamento'; $bodyAttributes = 'onload="calc()"'; ob_start(); ?>
<script>
        function addItem(desc = '', qtd = 1, val = 0) {
            const tr = document.createElement('tr');
            tr.innerHTML = `
                <td><input name="itens[][descricao]" class="form-control" value="${desc}" required></td>
                <td><input type="number" name="itens[][quantidade]" class="form-control qtd" value="${qtd}" onchange="calc()" required></td>
                <td><input type="number" step="0.01" name="itens[][valor_unitario]" class="form-control val" value="${val}" onchange="calc()" required></td>
                <td><input type="number" step="0.01" name="itens[][subtotal]" class="form-control subtotal" readonly></td>
                <td><button type="button" class="btn btn-sm btn-danger" onclick="this.closest('tr').remove();calc()">X</button></td>
            `;
            document.getElementById('itens').appendChild(tr);
            calc();
        }

        function calc() {
            let total = 0;
            document.querySelectorAll('#itens tr').forEach(row => {
                const qtd = parseFloat(row.querySelector('.qtd').value) || 0;
                const val = parseFloat(row.querySelector('.val').value) || 0;
                const sub = qtd * val;
                row.querySelector('.subtotal').value = sub.toFixed(2);
                total += sub;
            });
            document.getElementById('total').value = total.toFixed(2);
        }
    </script>
<div class="container mt-4">
    <h2><?= isset($orcamento) ? 'Editar' : 'Novo' ?> Orçamento</h2>
    <form method="post" action="<?= isset($orcamento) ? '/orcamentos/atualizar/' . $orcamento['id'] : '/orcamentos/salvar' ?>">
        <div class="row">
            <div class="col-md-6 mb-3">
                <label>Nome do Cliente</label>
                <input name="cliente_nome" class="form-control" value="<?= htmlspecialchars($orcamento['cliente_nome'] ?? '') ?>" required>
            </div>
            <div class="col-md-6 mb-3">
                <label>Contato</label>
                <input name="cliente_contato" class="form-control" value="<?= htmlspecialchars($orcamento['cliente_contato'] ?? '') ?>">
            </div>
            <div class="col-md-6 mb-3">
                <label>Data</label>
                <input type="date" name="data" class="form-control" value="<?= htmlspecialchars($orcamento['data'] ?? date('Y-m-d')) ?>" required>
            </div>
            <div class="col-md-6 mb-3">
                <label>Validade</label>
                <input type="date" name="validade" class="form-control" value="<?= htmlspecialchars($orcamento['validade'] ?? date('Y-m-d', strtotime('+3 months'))) ?>" required>
            </div>
        </div>

        <h5>Itens</h5>
        <table class="table table-sm table-bordered">
            <thead><tr><th>Descrição</th><th>Qtd</th><th>Unitário</th><th>Subtotal</th><th></th></tr></thead>
            <tbody id="itens"></tbody>
        </table>
        <button type="button" onclick="addItem()" class="btn btn-sm btn-secondary">Adicionar Item</button>

        <div class="mt-3 mb-3">
            <label>Total</label>
            <input type="number" name="total" id="total" class="form-control" readonly>
        </div>

        <div class="mb-3">
            <label>Observações</label>
            <textarea name="observacoes" class="form-control"><?= htmlspecialchars($orcamento['observacoes'] ?? '') ?></textarea>
        </div>
        <button class="btn btn-success">Salvar</button>
    </form>
</div>
<?php $content = ob_get_clean(); include __DIR__ . '/../layout.php'; ?>
