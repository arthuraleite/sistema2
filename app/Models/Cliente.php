<?php
// app/Models/Cliente.php

class Cliente {
    public static function listar() {
        global $pdo;
        return $pdo->query("SELECT * FROM clientes ORDER BY nome")->fetchAll(PDO::FETCH_ASSOC);
    }

    public static function buscar($id) {
        global $pdo;
        $stmt = $pdo->prepare("SELECT * FROM clientes WHERE id = ?");
        $stmt->execute([$id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public static function cpfCnpjExiste($cpf_cnpj) {
        global $pdo;
        $stmt = $pdo->prepare("SELECT COUNT(*) FROM clientes WHERE cpf_cnpj = ?");
        $stmt->execute([$cpf_cnpj]);
        return $stmt->fetchColumn() > 0;
    }

    public static function salvar($dados) {
        global $pdo;
        $stmt = $pdo->prepare("
            INSERT INTO clientes (nome, telefone, email, cpf_cnpj, tipo, contato, responsavel, insc_municipal, insc_estadual, observacoes)
            VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)
        ");
        $stmt->execute([
            $dados['nome'], $dados['telefone'], $dados['email'],
            $dados['cpf_cnpj'], $dados['tipo'], $dados['contato'] ?? null,
            $dados['responsavel'] ?? null, $dados['insc_municipal'] ?? null,
            $dados['insc_estadual'] ?? null, $dados['observacoes'] ?? null
        ]);
    }

    public static function atualizar($id, $dados) {
        global $pdo;
        $stmt = $pdo->prepare("UPDATE clientes SET nome = ?, telefone = ?, email = ?, cpf_cnpj = ?, tipo = ?, contato = ?, responsavel = ?, insc_municipal = ?, insc_estadual = ?, observacoes = ?
            WHERE id = ?");
        $stmt->execute([
            $dados['nome'], $dados['telefone'], $dados['email'],
            $dados['cpf_cnpj'], $dados['tipo'], $dados['contato'] ?? null,
            $dados['responsavel'] ?? null, $dados['insc_municipal'] ?? null,
            $dados['insc_estadual'] ?? null, $dados['observacoes'] ?? null,
            $id
        ]);
    }

    public static function excluir($id) {
        global $pdo;
        $stmt = $pdo->prepare("DELETE FROM clientes WHERE id = ?");
        $stmt->execute([$id]);
    }

    public static function temPedidos($id) {
        global $pdo;
        $stmt = $pdo->prepare("SELECT COUNT(*) FROM pedidos WHERE cliente_id = ?");
        $stmt->execute([$id]);
        return $stmt->fetchColumn() > 0;
    }
}
