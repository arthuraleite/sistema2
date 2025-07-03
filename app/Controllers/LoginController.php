<?php
// app/Controllers/LoginController.php

class LoginController {
    public function index() {
        render('login');
    }

    public function autenticar() {
        global $pdo;

        $usuario = $_POST['usuario'] ?? '';
        $senha = $_POST['senha'] ?? '';

        $stmt = $pdo->prepare("SELECT * FROM usuarios WHERE usuario = ?");
        $stmt->execute([$usuario]);
        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($user && password_verify($senha, $user['senha'])) {
            $_SESSION['usuario'] = $user;
            redirect('/');
        } else {
            $_SESSION['erro_login'] = "Usuário ou senha inválidos.";
            redirect('/login');
        }
    }

    public function sair() {
        session_destroy();
        redirect('/login');
    }
}
