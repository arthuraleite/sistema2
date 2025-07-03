<?php
// app/Models/Orcamento.php

class Orcamento {
    public static function listar() {
        global $pdo;
        return $pdo->query("SELECT * FROM orcamentos ORDER BY data DESC")->fetchAll(PDO::FETCH_ASSOC);
    }

    public static function buscar($id) {
        global $pdo;
        $stmt = $pdo->prepare("SELECT * FROM orcamentos WHERE id = ?");
        $stmt->execute([$id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public static function salvar($dados, $itens) {
        global $pdo;
        $pdo->beginTransaction();

        $stmt = $pdo->prepare("
            INSERT INTO orcamentos (cliente_nome, cliente_contato, data, validade, observacoes, total)
            VALUES (?, ?, ?, ?, ?, ?)
        ");
        $stmt->execute([
            $dados['cliente_nome'],
            $dados['cliente_contato'],
            $dados['data'],
            $dados['validade'],
            $dados['observacoes'],
            $dados['total']
        ]);

        $orcamento_id = $pdo->lastInsertId();

        foreach ($itens as $item) {
            $stmt = $pdo->prepare("
                INSERT INTO orcamento_itens (orcamento_id, descricao, quantidade, valor_unitario, subtotal)
                VALUES (?, ?, ?, ?, ?)
            ");
            $stmt->execute([
                $orcamento_id,
                $item['descricao'],
                $item['quantidade'],
                $item['valor_unitario'],
                $item['subtotal']
            ]);
        }

        $pdo->commit();
    }

    public static function atualizar($id, $dados, $itens) {
        global $pdo;
        $pdo->beginTransaction();

        $stmt = $pdo->prepare("
            UPDATE orcamentos
            SET cliente_nome = ?, cliente_contato = ?, data = ?, validade = ?, observacoes = ?, total = ?
            WHERE id = ?
        ");
        $stmt->execute([
            $dados['cliente_nome'],
            $dados['cliente_contato'],
            $dados['data'],
            $dados['validade'],
            $dados['observacoes'],
            $dados['total'],
            $id
        ]);

        $pdo->prepare("DELETE FROM orcamento_itens WHERE orcamento_id = ?")->execute([$id]);

        foreach ($itens as $item) {
            $stmt = $pdo->prepare("
                INSERT INTO orcamento_itens (orcamento_id, descricao, quantidade, valor_unitario, subtotal)
                VALUES (?, ?, ?, ?, ?)
            ");
            $stmt->execute([
                $id,
                $item['descricao'],
                $item['quantidade'],
                $item['valor_unitario'],
                $item['subtotal']
            ]);
        }

        $pdo->commit();
    }

    public static function excluir($id) {
        global $pdo;
        $pdo->beginTransaction();
        $pdo->prepare("DELETE FROM orcamento_itens WHERE orcamento_id = ?")->execute([$id]);
        $pdo->prepare("DELETE FROM orcamentos WHERE id = ?")->execute([$id]);
        $pdo->commit();
    }

    public static function listarItens($orcamento_id) {
        global $pdo;
        $stmt = $pdo->prepare("SELECT * FROM orcamento_itens WHERE orcamento_id = ?");
        $stmt->execute([$orcamento_id]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public static function excluirExpirados() {
        global $pdo;
        $pdo->prepare("DELETE FROM orcamentos WHERE validade < CURDATE()")->execute();
    }
}
