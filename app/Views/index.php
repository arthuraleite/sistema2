<?php // app/Views/index.php ?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>
<body>
<nav class="navbar navbar-expand-lg navbar-light bg-light mb-4">
    <div class="container-fluid">
        <a class="navbar-brand" href="<?= BASE_URL ?>">Sistema</a>
        <div class="collapse navbar-collapse">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <li class="nav-item"><a class="nav-link" href="<?= BASE_URL ?>/clientes">Clientes</a></li>
                <li class="nav-item"><a class="nav-link" href="<?= BASE_URL ?>/produtos">Produtos</a></li>
                <li class="nav-item"><a class="nav-link" href="<?= BASE_URL ?>/pedidos">Pedidos</a></li>
                <li class="nav-item"><a class="nav-link" href="<?= BASE_URL ?>/orcamentos">Orçamentos</a></li>
                <li class="nav-item"><a class="nav-link" href="<?= BASE_URL ?>/financeiro">Financeiro</a></li>
                <li class="nav-item"><a class="nav-link" href="<?= BASE_URL ?>/usuarios">Usuários</a></li>
            </ul>
        </div>
    </div>
</nav>


<div class="container">
    <h2 class="mb-4">Dashboard</h2>

    <!-- Pedidos em Andamento -->
    <div class="mb-4">
        <h4>Pedidos em Andamento (Próximos 7 dias)</h4>
        <table class="table table-sm table-striped">
            <thead>
                <tr>
                    <th>Cliente</th>
                    <th>Status</th>
                    <th>Previsão de Entrega</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($emAndamento as $p): ?>
                    <tr>
                    <td><?= htmlspecialchars($p['cliente_nome']) ?></td>
                    <td><?= htmlspecialchars($p['status']) ?></td>
                        <td><?= date('d/m/Y', strtotime($p['previsao_entrega'])) ?></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>

    <!-- Pedidos Prontos Não Entregues -->
    <div class="mb-4">
        <h4>Pedidos Prontos, Não Entregues</h4>
        <table class="table table-sm table-striped">
            <thead>
                <tr>
                    <th>Cliente</th>
                    <th>Telefone</th>
                    <th>Previsão de Entrega</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($prontos as $p): ?>
                    <tr>
                        <td><?= htmlspecialchars($p['cliente_nome']) ?></td>
                        <td><?= htmlspecialchars($p['telefone']) ?></td>
                        <td><?= date('d/m/Y', strtotime($p['previsao_entrega'])) ?></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>

    <!-- Contas a Pagar (Recorrentes) -->
    <div class="mb-4">
        <h4>Contas a Pagar</h4>
        <ul class="list-group">
            <?php foreach ($recorrentes as $c):
                $dias = (strtotime($c['proxima_data']) - strtotime(date('Y-m-d'))) / 86400;
                $alerta = $dias <= 3 ? 'text-danger fw-bold' : '';
            ?>
                <li class="list-group-item d-flex justify-content-between align-items-center">
                    <?= htmlspecialchars($c['descricao']) ?>
                    <span class="<?= $alerta ?>">
                        VENCIMENTO EM <?= $dias ?> DIA<?= $dias == 1 ? '' : 'S' ?>
                    </span>
                </li>
            <?php endforeach; ?>
        </ul>
    </div>

    <!-- Finanças -->
    <div class="mb-4">
        <h4>Finanças (<?= date('d/m/Y', strtotime($inicio)) ?> até <?= date('d/m/Y', strtotime($fim)) ?>)</h4>
        <div class="row mb-4">
            <div class="col-md-6">
                <div class="alert alert-success">
                    <strong>Total de Entradas:</strong> R$ <?= number_format($entradas, 2, ',', '.') ?>
                </div>
            </div>
            <div class="col-md-6">
                <div class="alert alert-danger">
                    <strong>Total de Saídas:</strong> R$ <?= number_format($saidas, 2, ',', '.') ?>
                </div>
            </div>
        </div>

        <!-- Gráfico de Barras -->
        <canvas id="graficoFinanceiro" height="100"></canvas>

        <!-- Gráfico Temporal -->
        <h5 class="mt-5">Evolução Temporal (Exemplo)</h5>
        <canvas id="graficoTemporal" height="120"></canvas>
    </div>

    <!-- Filtro de Período -->
    <div class="mb-4">
        <form method="get" class="row g-3">
            <div class="col-auto">
                <label for="inicio" class="form-label">Início:</label>
                <input type="date" name="inicio" id="inicio" class="form-control" value="<?= htmlspecialchars($inicio) ?>">
            </div>
            <div class="col-auto">
                <label for="fim" class="form-label">Fim:</label>
                <input type="date" name="fim" id="fim" class="form-control" value="<?= htmlspecialchars($fim) ?>">
            </div>
            <div class="col-auto d-flex align-items-end">
                <button type="submit" class="btn btn-primary">Filtrar</button>
            </div>
        </form>
    </div>
</div>

<script>
const ctx = document.getElementById('graficoFinanceiro').getContext('2d');
new Chart(ctx, {
    type: 'bar',
    data: {
        labels: ['Entradas', 'Saídas'],
        datasets: [{
            label: 'R$ por tipo',
            data: [<?= $entradas ?>, <?= $saidas ?>],
            backgroundColor: ['#28a745', '#dc3545']
        }]
    },
    options: {
        responsive: true,
        plugins: { legend: { display: false } },
        scales: { y: { beginAtZero: true } }
    }
});

const ctxTemporal = document.getElementById('graficoTemporal').getContext('2d');
new Chart(ctxTemporal, {
    type: 'line',
    data: {
        labels: [
            '<?= date("d/m", strtotime("-5 days")) ?>',
            '<?= date("d/m", strtotime("-4 days")) ?>',
            '<?= date("d/m", strtotime("-3 days")) ?>',
            '<?= date("d/m", strtotime("-2 days")) ?>',
            '<?= date("d/m", strtotime("-1 days")) ?>',
            '<?= date("d/m") ?>'
        ],
        datasets: [
            {
                label: 'Entradas',
                data: [100, 250, 300, 150, 400, 280],
                borderColor: '#28a745',
                tension: 0.4
            },
            {
                label: 'Saídas',
                data: [80, 180, 220, 100, 250, 260],
                borderColor: '#dc3545',
                tension: 0.4
            }
        ]
    },
    options: {
        responsive: true,
        scales: {
            y: {
                beginAtZero: true
            }
        }
    }
});
</script>
</body>
</html>
