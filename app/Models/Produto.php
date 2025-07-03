<?php
// app/Models/Produto.php

class Produto {
    public static function listar() {
        global $pdo;
        return $pdo->query("SELECT * FROM produtos ORDER BY descricao")->fetchAll(PDO::FETCH_ASSOC);
    }

    public static function buscar($id) {
        global $pdo;
        $stmt = $pdo->prepare("SELECT * FROM produtos WHERE id = ?");
        $stmt->execute([$id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public static function salvar($dados) {
        global $pdo;
        $stmt = $pdo->prepare("INSERT INTO produtos (descricao, valor_unitario) VALUES (?, ?)");
        $stmt->execute([$dados['descricao'], $dados['valor_unitario']]);
    }

    public static function atualizar($id, $dados) {
        global $pdo;
        $stmt = $pdo->prepare("UPDATE produtos SET descricao = ?, valor_unitario = ? WHERE id = ?");
        $stmt->execute([$dados['descricao'], $dados['valor_unitario'], $id]);
    }

    public static function excluir($id) {
        global $pdo;
        $stmt = $pdo->prepare("DELETE FROM produtos WHERE id = ?");
        $stmt->execute([$id]);
    }
}
