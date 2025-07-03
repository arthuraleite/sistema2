<?php
// app/Controllers/ProdutosController.php
require_once '../app/Models/Produto.php';

class ProdutosController {
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
        redirect('/produtos');
    }

    public function editar($id) {
        $produto = Produto::buscar($id);
        render('produtos/editar', compact('produto'));
    }

    public function atualizar($id) {
        $dados = $_POST;
        Produto::atualizar($id, $dados);
        redirect('/produtos');
    }

    public function excluir($id) {
        Produto::excluir($id);
        redirect('/produtos');
    }
}
