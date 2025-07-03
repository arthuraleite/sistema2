<?php
// app/Models/Financeiro.php

class Financeiro {
    public static function listar() {
        global $pdo;
        return $pdo->query("SELECT * FROM financeiro ORDER BY data DESC")->fetchAll(PDO::FETCH_ASSOC);
    }

    public static function buscar($id) {
        global $pdo;
        $stmt = $pdo->prepare("SELECT * FROM financeiro WHERE id = ?");
        $stmt->execute([$id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public static function salvar($dados) {
        global $pdo;
        $stmt = $pdo->prepare("INSERT INTO financeiro (descricao, valor, data) VALUES (?, ?, ?)");
        $stmt->execute([$dados['descricao'], $dados['valor'], $dados['data']]);
    }

    public static function atualizar($id, $dados) {
        global $pdo;
        $stmt = $pdo->prepare("UPDATE financeiro SET descricao = ?, valor = ?, data = ? WHERE id = ?");
        $stmt->execute([$dados['descricao'], $dados['valor'], $dados['data'], $id]);
    }

    public static function excluir($id) {
        global $pdo;
        $stmt = $pdo->prepare("DELETE FROM financeiro WHERE id = ?");
        $stmt->execute([$id]);
    }
}
