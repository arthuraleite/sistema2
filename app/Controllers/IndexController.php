<?php
// app/Controllers/IndexController.php

class IndexController {
    public function index() {
        // Define valores fictícios para o dashboard
        $inicio = $_GET['inicio'] ?? date('Y-m-d', strtotime('-7 days'));
        $fim = $_GET['fim'] ?? date('Y-m-d');

        // Exemplo de dados
        $emAndamento = [
            ['cliente_nome' => 'João Silva', 'status' => 'Em Andamento', 'previsao_entrega' => date('Y-m-d', strtotime('+3 days'))],
            ['cliente_nome' => 'Maria Compradora', 'status' => 'Em Andamento', 'previsao_entrega' => date('Y-m-d', strtotime('+6 days'))]
        ];

        $prontos = [
            ['cliente_nome' => 'Empresa ABC Ltda.', 'telefone' => '(11) 88888-1111', 'previsao_entrega' => date('Y-m-d', strtotime('+1 days'))]
        ];

        $recorrentes = [
            ['descricao' => 'Conta de Luz', 'proxima_data' => date('Y-m-d', strtotime('+2 days'))],
            ['descricao' => 'Internet', 'proxima_data' => date('Y-m-d', strtotime('+10 days'))]
        ];

        $entradas = 1500.00;
        $saidas = 600.00;

        render('index', compact('inicio','fim','emAndamento','prontos','recorrentes','entradas','saidas'));
    }
}
