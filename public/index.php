<?php
session_start();
require_once '../app/Config/config.php';
require_once '../app/Core/Router.php';
require_once '../app/Core/Controller.php';

// Autoloader dos Models
spl_autoload_register(function ($class) {
    $modelPath = "../app/Models/$class.php";
    if (file_exists($modelPath)) {
        require_once $modelPath;
    }
});

// Roteamento
$url = $_GET['url'] ?? 'index';
$url = rtrim($url, '/');
$segments = explode('/', $url);

$controllerName = ucfirst($segments[0]) . 'Controller';
$method = $segments[1] ?? 'index';
$params = array_slice($segments, 2);

// Controllers
$controllerPath = "../app/Controllers/{$controllerName}.php";
if (file_exists($controllerPath)) {
    require_once $controllerPath;
    $controller = new $controllerName;
    if (method_exists($controller, $method)) {
        call_user_func_array([$controller, $method], $params);
        exit;
    }
}

// Rota especial: PDF de orçamento (view isolada)
if ($segments[0] === 'orcamentos' && $segments[1] === 'pdf') {
    $id = $segments[2] ?? null;
    if ($id) {
        require_once '../app/Models/Orcamento.php';
        $orcModel = new Orcamento();
        $orcamento = $orcModel->buscarPorId($id);
        $itens = $orcModel->itens($id);
        require_once '../app/Views/orcamentos/pdf.php';
        exit;
    }
}

echo "Página não encontrada.";
