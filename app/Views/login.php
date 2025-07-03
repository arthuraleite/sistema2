<?php $title = 'Login'; $bodyAttributes = 'class="bg-light"'; ob_start(); ?>
<div class="container d-flex justify-content-center align-items-center" style="height:100vh;">
    <div class="card p-4 shadow" style="min-width: 300px;">
        <h4 class="mb-3 text-center">Acesso ao Sistema</h4>

        <?php if (!empty($_SESSION['erro_login'])): ?>
            <div class="alert alert-danger"><?= htmlspecialchars($_SESSION['erro_login']) ?></div>
            <?php unset($_SESSION['erro_login']); ?>
        <?php endif; ?>

        <form method="post" action="<?= BASE_URL ?>/login/autenticar">
            <div class="mb-3">
                <label for="usuario" class="form-label">Usuário</label>
                <input type="text" class="form-control" name="usuario" id="usuario" required>
            </div>
            <div class="mb-3">
                <label for="senha" class="form-label">Senha</label>
                <input type="password" class="form-control" name="senha" id="senha" required>
            </div>
            <button type="submit" class="btn btn-primary w-100">Entrar</button>
        </form>
    </div>
<?php $content = ob_get_clean(); include __DIR__ . '/layout.php'; ?>
