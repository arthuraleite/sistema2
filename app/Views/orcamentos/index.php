<?php $title = "Orçamentos"; ?>
<div class="container mt-4">
    <h2>Orçamentos</h2>
    <a href="<?= BASE_URL ?>/orcamentos/novo" class="btn btn-primary mb-3">Novo Orçamento</a>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Cliente</th>
                <th>Contato</th>
                <th>Data</th>
                <th>Validade</th>
                <th>Total</th>
                <th>Ações</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($orcamentos as $o): ?>
                <tr>
                    <td><?= htmlspecialchars($o['cliente_nome']) ?></td>
                    <td><?= htmlspecialchars($o['cliente_contato']) ?></td>
                    <td><?= date('d/m/Y', strtotime($o['data'])) ?></td>
                    <td><?= date('d/m/Y', strtotime($o['validade'])) ?></td>
                    <td>R$ <?= number_format($o['total'], 2, ',', '.') ?></td>
                    <td>
                        <a href="<?= BASE_URL ?>/orcamentos/ver/<?= $o['id'] ?>" class="btn btn-sm btn-info">Ver</a>
                        <a href="<?= BASE_URL ?>/orcamentos/editar/<?= $o['id'] ?>" class="btn btn-sm btn-warning">Editar</a>
                        <a href="<?= BASE_URL ?>/orcamentos/pdf/<?= $o['id'] ?>" class="btn btn-sm btn-secondary" target="_blank">PDF</a>
                        <a href="<?= BASE_URL ?>/orcamentos/converter/<?= $o['id'] ?>" class="btn btn-sm btn-success">Transformar</a>
                        <a href="<?= BASE_URL ?>/orcamentos/excluir/<?= $o['id'] ?>" onclick="return confirm('Excluir orçamento?')" class="btn btn-sm btn-danger">Excluir</a>
                    </td>
                </tr>
            <?php endforeach ?>
        </tbody>
    </table>
</div>
