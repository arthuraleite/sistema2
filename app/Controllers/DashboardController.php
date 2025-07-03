<?php
// app/Controllers/DashboardController.php

class DashboardController {
    public function index() {
        global $pdo;

        // Pedidos em andamento nos próximos 7 dias
        $emAndamento = $pdo->query("
            SELECT p.*, c.nome AS cliente_nome
            FROM pedidos p
            JOIN clientes c ON c.id = p.cliente_id
            WHERE p.status = 'Em Andamento' AND p.previsao_entrega BETWEEN CURDATE() AND DATE_ADD(CURDATE(), INTERVAL 7 DAY)
            ORDER BY p.previsao_entrega ASC
        ")->fetchAll(PDO::FETCH_ASSOC);

        // Pedidos prontos mas não entregues
        $prontos = $pdo->query("
            SELECT p.*, c.nome AS cliente_nome, c.telefone
            FROM pedidos p
            JOIN clientes c ON c.id = p.cliente_id
            WHERE p.status = 'Pronto'
        ")->fetchAll(PDO::FETCH_ASSOC);

        // Contas recorrentes próximas do vencimento
        $recorrentes = $pdo->query("
            SELECT * FROM contas_recorrentes
            WHERE proxima_data BETWEEN CURDATE() AND DATE_ADD(CURDATE(), INTERVAL 7 DAY)
        ")->fetchAll(PDO::FETCH_ASSOC);

        // Filtro de período para entradas/saídas
        $inicio = $_GET['inicio'] ?? date('Y-m-d', strtotime('-7 days'));
        $fim = $_GET['fim'] ?? date('Y-m-d');

        // Entradas = pagamentos de pedidos (movimentações)
        $entradas = $pdo->query("
            SELECT SUM(valor) FROM movimentacoes
            WHERE data BETWEEN '$inicio' AND '$fim'
        ")->fetchColumn() ?? 0;

        // Saídas = lançamentos financeiros
        $saidas = $pdo->query("
            SELECT SUM(valor) FROM financeiro
            WHERE data BETWEEN '$inicio' AND '$fim'
        ")->fetchColumn() ?? 0;

        include '../app/Views/index.php';
    }
}
