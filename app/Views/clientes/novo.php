<?php $title = "Novo Cliente"; ?>
<div class="container mt-4">
    <h2>Novo Cliente</h2>
    <form method="post" action="<?= BASE_URL ?>/clientes/salvar">
        <div class="row">
            <div class="mb-3 col-md-6">
                <label>Nome</label>
                <input type="text" name="nome" class="form-control" required>
            </div>
            <div class="mb-3 col-md-6">
                <label>Telefone</label>
                <input type="text" name="telefone" class="form-control">
            </div>
        </div>
        <div class="row">
            <div class="mb-3 col-md-6">
                <label>Email</label>
                <input type="email" name="email" class="form-control">
            </div>
            <div class="mb-3 col-md-6">
                <label>CPF/CNPJ</label>
                <input type="text" name="cpf_cnpj" class="form-control" required>
            </div>
        </div>
        <div class="row">
            <div class="mb-3 col-md-3">
                <label>Tipo</label>
                <select name="tipo" class="form-control">
                    <option value="cpf">CPF</option>
                    <option value="cnpj">CNPJ</option>
                </select>
            </div>
            <div class="mb-3 col-md-3">
                <label>Contato</label>
                <input type="text" name="contato" class="form-control">
            </div>
            <div class="mb-3 col-md-3">
                <label>Responsável</label>
                <input type="text" name="responsavel" class="form-control">
            </div>
            <div class="mb-3 col-md-3">
                <label>Insc. Municipal</label>
                <input type="text" name="insc_municipal" class="form-control">
            </div>
        </div>
        <div class="row">
            <div class="mb-3 col-md-6">
                <label>Insc. Estadual</label>
                <input type="text" name="insc_estadual" class="form-control">
            </div>
            <div class="mb-3 col-md-6">
                <label>Observações</label>
                <textarea name="observacoes" class="form-control"></textarea>
            </div>
        </div>
        <button type="submit" class="btn btn-success">Salvar</button>
    </form>
</div>
