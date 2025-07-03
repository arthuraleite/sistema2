<?php
// app/Controllers/OrcamentosController.php
require_once '../app/Models/Orcamento.php';
require_once '../app/Models/Pedido.php';
require_once '../app/Models/Cliente.php';

class OrcamentosController {
    public function index() {
        Orcamento::excluirExpirados(); // remove orçamentos vencidos
        $orcamentos = Orcamento::listar();
        render('orcamentos/index', compact('orcamentos'));
    }

    public function novo() {
        render('orcamentos/novo', compact('clientes'));
    }

    public function salvar() {
        $dados = [
            'cliente_nome'     => $_POST['cliente_nome'],
            'cliente_contato'  => $_POST['cliente_contato'],
            'data'             => $_POST['data'],
            'validade'         => $_POST['validade'],
            'observacoes'      => $_POST['observacoes'],
            'total'            => $_POST['total']
        ];

        $itens = $_POST['itens'] ?? [];
        Orcamento::salvar($dados, $itens);
        redirect('/orcamentos');
    }

    public function editar($id) {
        $orcamento = Orcamento::buscar($id);
        $itens = Orcamento::listarItens($id);
        render('orcamentos/editar', compact('orcamento','itens'));
    }

    public function atualizar($id) {
        $dados = [
            'cliente_nome'     => $_POST['cliente_nome'],
            'cliente_contato'  => $_POST['cliente_contato'],
            'data'             => $_POST['data'],
            'validade'         => $_POST['validade'],
            'observacoes'      => $_POST['observacoes'],
            'total'            => $_POST['total']
        ];
        $itens = $_POST['itens'] ?? [];
        Orcamento::atualizar($id, $dados, $itens);
        redirect('/orcamentos');
    }

    public function excluir($id) {
        Orcamento::excluir($id);
        redirect('/orcamentos');
    }

    public function ver($id) {
        $orcamento = Orcamento::buscar($id);
        $itens = Orcamento::listarItens($id);
        render('orcamentos/ver', compact('orcamento','itens'));
    }

    public function pdf($id) {
        $orcamento = Orcamento::buscar($id);
        $itens = Orcamento::listarItens($id);
        include '../app/Views/orcamentos/pdf.php'; // saída como PDF com headers
    }

    public function converter($id) {
        $orcamento = Orcamento::buscar($id);
        $itens = Orcamento::listarItens($id);
        $clientes = Cliente::listar();
        render('orcamentos/converter', compact('orcamento','itens','clientes'));
    }
}

