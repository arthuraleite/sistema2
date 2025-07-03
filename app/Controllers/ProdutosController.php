<?php
// app/Controllers/ProdutosController.php
require_once '../app/Models/Produto.php';

class ProdutosController {
    public function __construct() {
        if (!isset($_SESSION['usuario'])) {
            redirect('/login');
        }
    }
    public function index() {
        $produtos = Produto::listar();
        include '../app/Views/produtos/index.php';
    }

    public function novo() {
        include '../app/Views/produtos/novo.php';
    }

    public function salvar() {
        $dados = $_POST;
        Produto::salvar($dados);
        $mensagem = 'Produto salvo com sucesso.';
        $voltar = $_SERVER['HTTP_REFERER'] ?? BASE_URL . '/produtos';
        include '../app/Views/confirmacao.php';
    }

    public function editar($id) {
        $produto = Produto::buscar($id);
        include '../app/Views/produtos/editar.php';
    }

    public function atualizar($id) {
        $dados = $_POST;
        Produto::atualizar($id, $dados);
        $mensagem = 'Produto atualizado com sucesso.';
        $voltar = $_SERVER['HTTP_REFERER'] ?? BASE_URL . '/produtos';
        include '../app/Views/confirmacao.php';
    }

    public function excluir($id) {
        Produto::excluir($id);
        redirect('/produtos');
    }
}
