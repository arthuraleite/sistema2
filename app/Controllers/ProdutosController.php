<?php
// app/Controllers/ProdutoController.php
require_once '../app/Models/Produto.php';

class ProdutosController {
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
        redirect('/produtos');
    }

    public function editar($id) {
        $produto = Produto::buscar($id);
        include '../app/Views/produtos/editar.php';
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
