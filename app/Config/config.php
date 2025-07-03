<?php
// app/Config/config.php

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

define('DB_HOST', 'localhost');
define('DB_NAME', 'sistema');
define('DB_USER', 'root');
define('DB_PASS', '');
define('BASE_URL', '/sistema2/public');

try {
    $pdo = new PDO("mysql:host=".DB_HOST.";dbname=".DB_NAME, DB_USER, DB_PASS, [
        PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"
    ]);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Erro ao conectar no banco de dados: " . $e->getMessage());
}

// Função simples para redirecionar
function redirect($url) {
    header("Location: $url");
    exit;
}
