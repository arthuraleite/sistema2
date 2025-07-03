<?php $title = "Novo Usuário"; ?>
<div class="container mt-4">
    <h2>Novo Usuário</h2>
    <form method="post" action="<?= BASE_URL ?>/usuarios/salvar">
        <div class="mb-3">
            <label for="usuario" class="form-label">Usuário</label>
            <input type="text" name="usuario" class="form-control" required>
        </div>
        <div class="mb-3">
            <label for="senha" class="form-label">Senha</label>
            <input type="password" name="senha" class="form-control" required>
        </div>
        <div class="mb-3">
            <label for="tipo" class="form-label">Tipo</label>
            <select name="tipo" class="form-control" required>
                <option value="admin">Administrador</option>
                <option value="comum">Comum</option>
            </select>
        </div>
        <button type="submit" class="btn btn-primary">Salvar</button>
    </form>
</div>
