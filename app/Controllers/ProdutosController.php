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
        render('produtos/index', compact('produtos'));
    }

    public function novo() {
        render('produtos/novo');
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
        render('produtos/editar', compact('produto'));
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
