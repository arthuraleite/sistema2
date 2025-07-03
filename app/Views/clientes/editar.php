<?php $title = 'Editar Cliente'; ob_start(); ?>
<div class="container mt-4">
    <h2>Editar Cliente</h2>
    <form method="post" action="<?= BASE_URL ?>/clientes/atualizar/<?= $cliente['id'] ?>">
        <div class="row">
            <div class="mb-3 col-md-6">
                <label>Nome</label>
                <input type="text" name="nome" class="form-control" value="<?= htmlspecialchars($cliente['nome']) ?>" required>
            </div>
            <div class="mb-3 col-md-6">
                <label>Telefone</label>
                <input type="text" name="telefone" class="form-control" value="<?= htmlspecialchars($cliente['telefone']) ?>">
            </div>
        </div>
        <div class="row">
            <div class="mb-3 col-md-6">
                <label>Email</label>
                <input type="email" name="email" class="form-control" value="<?= htmlspecialchars($cliente['email']) ?>">
            </div>
            <div class="mb-3 col-md-6">
                <label>CPF/CNPJ</label>
                <input type="text" name="cpf_cnpj" class="form-control" value="<?= htmlspecialchars($cliente['cpf_cnpj']) ?>" required>
            </div>
        </div>
        <div class="row">
            <div class="mb-3 col-md-3">
                <label>Tipo</label>
                <select name="tipo" class="form-control">
                    <option value="cpf" <?= $cliente['tipo'] == 'cpf' ? 'selected' : '' ?>>CPF</option>
                    <option value="cnpj" <?= $cliente['tipo'] == 'cnpj' ? 'selected' : '' ?>>CNPJ</option>
                </select>
            </div>
            <div class="mb-3 col-md-3">
                <label>Contato</label>
                <input type="text" name="contato" class="form-control" value="<?= htmlspecialchars($cliente['contato']) ?>">
            </div>
            <div class="mb-3 col-md-3">
                <label>Responsável</label>
                <input type="text" name="responsavel" class="form-control" value="<?= htmlspecialchars($cliente['responsavel']) ?>">
            </div>
            <div class="mb-3 col-md-3">
                <label>Insc. Municipal</label>
                <input type="text" name="insc_municipal" class="form-control" value="<?= htmlspecialchars($cliente['insc_municipal']) ?>">
            </div>
        </div>
        <div class="row">
            <div class="mb-3 col-md-6">
                <label>Insc. Estadual</label>
                <input type="text" name="insc_estadual" class="form-control" value="<?= htmlspecialchars($cliente['insc_estadual']) ?>">
            </div>
            <div class="mb-3 col-md-6">
                <label>Observações</label>
                <textarea name="observacoes" class="form-control"><?= htmlspecialchars($cliente['observacoes']) ?></textarea>
            </div>
        </div>
        <button type="submit" class="btn btn-success">Atualizar</button>
    </form>
</div>
<?php $content = ob_get_clean(); include __DIR__ . '/../layout.php'; ?>
