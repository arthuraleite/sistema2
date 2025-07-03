<?php
// app/Models/Pedido.php

class Pedido {
    public static function listar() {
        global $pdo;
        return $pdo->query("
            SELECT p.*, c.nome AS cliente_nome
            FROM pedidos p
            JOIN clientes c ON c.id = p.cliente_id
            ORDER BY p.data_pedido DESC
        ")->fetchAll(PDO::FETCH_ASSOC);
    }

    public static function buscar($id) {
        global $pdo;
        $stmt = $pdo->prepare("
            SELECT p.*, c.nome AS cliente_nome
            FROM pedidos p
            JOIN clientes c ON c.id = p.cliente_id
            WHERE p.id = ?
        ");
        $stmt->execute([$id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public static function salvar($dados, $itens, $pagamentos) {
        global $pdo;

        $pdo->beginTransaction();

        // Inserir pedido
        $stmt = $pdo->prepare("
            INSERT INTO pedidos (cliente_id, data_pedido, previsao_entrega, status, observacoes, total)
            VALUES (?, ?, ?, ?, ?, ?)
        ");
        $stmt->execute([
            $dados['cliente_id'],
            $dados['data_pedido'],
            $dados['previsao_entrega'],
            $dados['status'],
            $dados['observacoes'],
            $dados['total']
        ]);
        $pedido_id = $pdo->lastInsertId();

        // Inserir itens
        foreach ($itens as $item) {
            $stmt = $pdo->prepare("
                INSERT INTO pedido_itens (pedido_id, descricao, quantidade, valor_unitario, subtotal)
                VALUES (?, ?, ?, ?, ?)
            ");
            $stmt->execute([
                $pedido_id,
                $item['descricao'],
                $item['quantidade'],
                $item['valor_unitario'],
                $item['subtotal']
            ]);
        }

        // Inserir movimentações (pagamentos)
        foreach ($pagamentos as $mov) {
            $stmt = $pdo->prepare("
                INSERT INTO movimentacoes (pedido_id, valor, descricao, data, forma_pagamento)
                VALUES (?, ?, ?, ?, ?)
            ");
            $stmt->execute([
                $pedido_id,
                $mov['valor'],
                $mov['descricao'],
                $mov['data'],
                $mov['forma_pagamento']
            ]);
        }

        $pdo->commit();
    }

    public static function excluir($id) {
        global $pdo;
        $pdo->beginTransaction();
        $pdo->prepare("DELETE FROM pedido_itens WHERE pedido_id = ?")->execute([$id]);
        $pdo->prepare("DELETE FROM movimentacoes WHERE pedido_id = ?")->execute([$id]);
        $pdo->prepare("DELETE FROM pedidos WHERE id = ?")->execute([$id]);
        $pdo->commit();
    }

    public static function listarItens($pedido_id) {
        global $pdo;
        $stmt = $pdo->prepare("SELECT * FROM pedido_itens WHERE pedido_id = ?");
        $stmt->execute([$pedido_id]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public static function listarPagamentos($pedido_id) {
        global $pdo;
        $stmt = $pdo->prepare("SELECT * FROM movimentacoes WHERE pedido_id = ?");
        $stmt->execute([$pedido_id]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
