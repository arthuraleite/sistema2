<?php
// app/Controllers/PedidosController.php
require_once '../app/Models/Pedido.php';
require_once '../app/Models/Cliente.php';
require_once '../app/Models/Produto.php';

class PedidosController {
    public function index() {
        $pedidos = Pedido::listar();
        render('pedidos/index', compact('pedidos'));
    }

    public function novo() {
        $clientes = Cliente::listar();
        $produtos = Produto::listar();
        render('pedidos/novo', compact('clientes','produtos'));
    }

    public function salvar() {
        $dados = [
            'cliente_id'       => $_POST['cliente_id'],
            'data_pedido'      => $_POST['data_pedido'],
            'previsao_entrega' => $_POST['previsao_entrega'],
            'status'           => $_POST['status'],
            'observacoes'      => $_POST['observacoes'],
            'total'            => $_POST['total']
        ];

        $itens = $_POST['itens'] ?? [];
        $pagamentos = $_POST['pagamentos'] ?? [];

        Pedido::salvar($dados, $itens, $pagamentos);
        redirect('/pedidos');
    }

    public function ver($id) {
        $pedido = Pedido::buscar($id);
        $itens = Pedido::listarItens($id);
        $movs = Pedido::listarPagamentos($id);
        render('pedidos/ver', compact('pedido','itens','movs'));
    }

    public function excluir($id) {
        Pedido::excluir($id);
        redirect('/pedidos');
    }
}
