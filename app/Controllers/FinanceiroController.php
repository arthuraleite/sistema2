<?php
// app/Controllers/FinanceiroController.php
require_once '../app/Models/Financeiro.php';

class FinanceiroController {
    public function index() {
        $lancamentos = Financeiro::listar();
        include '../app/Views/financeiro/index.php';
    }

    public function novo() {
        include '../app/Views/financeiro/novo.php';
    }

    public function salvar() {
        $dados = $_POST;
        Financeiro::salvar($dados);
        redirect('/financeiro');
    }

    public function editar($id) {
        $lancamento = Financeiro::buscar($id);
        include '../app/Views/financeiro/editar.php';
    }

    public function atualizar($id) {
        $dados = $_POST;
        Financeiro::atualizar($id, $dados);
        redirect('/financeiro');
    }

    public function excluir($id) {
        Financeiro::excluir($id);
        redirect('/financeiro');
    }
}
