<?php
// app/Controllers/ClientesController.php
require_once '../app/Models/Cliente.php';

class ClientesController {
    public function __construct() {
        if (!isset($_SESSION['usuario'])) {
            redirect('/login');
        }
    }
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
        $mensagem = 'Cliente salvo com sucesso.';
        $voltar = $_SERVER['HTTP_REFERER'] ?? BASE_URL . '/clientes';
        include '../app/Views/confirmacao.php';
    }

    public function editar($id) {
        $cliente = Cliente::buscar($id);
        render('clientes/editar', compact('cliente'));
    }

    public function atualizar($id) {
        $dados = $_POST;
        Cliente::atualizar($id, $dados);
        $mensagem = 'Cliente atualizado com sucesso.';
        $voltar = $_SERVER['HTTP_REFERER'] ?? BASE_URL . '/clientes';
        include '../app/Views/confirmacao.php';
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
