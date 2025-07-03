<?php
// app/Controllers/UsuariosController.php

class UsuariosController {
    public function index() {
        global $pdo;

        if (!isset($_SESSION['usuario']) || $_SESSION['usuario']['tipo'] !== 'admin') {
            http_response_code(403);
            echo "Acesso restrito";
            exit;
        }

        $usuarios = $pdo->query("SELECT * FROM usuarios")->fetchAll(PDO::FETCH_ASSOC);
        render('usuarios/index', compact('usuarios'));
    }

    public function novo() {
        render('usuarios/novo');
    }

    public function salvar() {
        global $pdo;

        $usuario = $_POST['usuario'];
        $senha = password_hash($_POST['senha'], PASSWORD_DEFAULT);
        $tipo = $_POST['tipo'];

        $stmt = $pdo->prepare("INSERT INTO usuarios (usuario, senha, tipo) VALUES (?, ?, ?)");
        $stmt->execute([$usuario, $senha, $tipo]);

        redirect('/usuarios');
    }

    public function excluir($id) {
        global $pdo;

        $stmt = $pdo->prepare("DELETE FROM usuarios WHERE id = ?");
        $stmt->execute([$id]);

        redirect('/usuarios');
    }
}
