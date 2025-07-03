<?php
// app/Controllers/ClientesController.php
require_once '../app/Models/Cliente.php';

class ClientesController {
    public function index() {
        $clientes = Cliente::listar();
        render('clientes/index', compact('clientes'));
    }

    public function novo() {
        render('clientes/novo');
    }

    public function salvar() {
        $dados = $_POST;

        if (Cliente::cpfCnpjExiste($dados['cpf_cnpj'])) {
            $_SESSION['erro'] = 'CPF/CNPJ já cadastrado.';
            redirect('/clientes/novo');
        }

        Cliente::salvar($dados);
        redirect('/clientes');
    }

    public function editar($id) {
        $cliente = Cliente::buscar($id);
        render('clientes/editar', compact('cliente'));
    }

    public function atualizar($id) {
        $dados = $_POST;
        Cliente::atualizar($id, $dados);
        redirect('/clientes');
    }

    public function excluir($id) {
        if (Cliente::temPedidos($id)) {
            $_SESSION['erro'] = "Não é possível excluir: cliente possui pedidos.";
            redirect('/clientes');
        }

        Cliente::excluir($id);
        redirect('/clientes');
    }
}
