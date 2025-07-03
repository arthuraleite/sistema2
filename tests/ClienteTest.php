<?php
use PHPUnit\Framework\TestCase;

require_once __DIR__ . '/../app/Models/Cliente.php';

class ClienteTest extends TestCase
{
    private $pdo;

    protected function setUp(): void
    {
        global $pdo;
        $this->pdo = new PDO('sqlite::memory:');
        $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $pdo = $this->pdo;
        $this->pdo->exec("CREATE TABLE clientes (
            id INTEGER PRIMARY KEY AUTOINCREMENT,
            nome TEXT,
            telefone TEXT,
            email TEXT,
            cpf_cnpj TEXT,
            tipo TEXT,
            contato TEXT,
            responsavel TEXT,
            insc_municipal TEXT,
            insc_estadual TEXT,
            observacoes TEXT
        )");
    }

    public function testSalvarEAtualizar()
    {
        global $pdo;
        $dados = [
            'nome' => 'Joao',
            'telefone' => '123',
            'email' => 'j@example.com',
            'cpf_cnpj' => '111',
            'tipo' => 'F',
            'contato' => null,
            'responsavel' => null,
            'insc_municipal' => null,
            'insc_estadual' => null,
            'observacoes' => null
        ];

        Cliente::salvar($dados);

        $id = $this->pdo->query('SELECT id FROM clientes')->fetchColumn();
        $this->assertNotEmpty($id);

        $nome = $this->pdo->query('SELECT nome FROM clientes WHERE id = ' . $id)->fetchColumn();
        $this->assertEquals('Joao', $nome);

        $dadosAtualizados = $dados;
        $dadosAtualizados['nome'] = 'Maria';

        Cliente::atualizar($id, $dadosAtualizados);

        $novoNome = $this->pdo->query('SELECT nome FROM clientes WHERE id = ' . $id)->fetchColumn();
        $this->assertEquals('Maria', $novoNome);
    }
}
