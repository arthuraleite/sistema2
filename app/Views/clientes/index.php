<?php $title = 'Clientes'; ob_start(); ?>
<div class="container mt-4">
    <h2>Clientes</h2>
    <a href="<?= BASE_URL ?>/clientes/novo" class="btn btn-primary mb-3">Novo Cliente</a>

    <?php if (!empty($_SESSION['erro'])): ?>
        <div class="alert alert-danger"><?= $_SESSION['erro'] ?></div>
        <?php unset($_SESSION['erro']); ?>
    <?php endif; ?>

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Nome</th>
                <th>Telefone</th>
                <th>Email</th>
                <th>Ações</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($clientes as $c): ?>
                <tr>
                    <td><?= $c['nome'] ?></td>
                    <td><?= $c['telefone'] ?></td>
                    <td><?= $c['email'] ?></td>
                    <td>
                        <a href="<?= BASE_URL ?>/clientes/editar/<?= $c['id'] ?>" class="btn btn-sm btn-warning">Editar</a>
                        <a href="<?= BASE_URL ?>/clientes/excluir/<?= $c['id'] ?>" onclick="return confirm('Excluir este cliente?')" class="btn btn-sm btn-danger">Excluir</a>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
</table>
</div>
<?php $content = ob_get_clean(); include __DIR__ . '/../layout.php'; ?>
