<?php
use PHPUnit\Framework\TestCase;

require_once __DIR__ . '/../app/Models/Orcamento.php';

class OrcamentoTest extends TestCase
{
    private $pdo;

    protected function setUp(): void
    {
        global $pdo;
        $this->pdo = new PDO('sqlite::memory:');
        $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $this->pdo->sqliteCreateFunction('CURDATE', function() {
            return date('Y-m-d');
        });
        $pdo = $this->pdo;
        $this->pdo->exec("CREATE TABLE orcamentos (
            id INTEGER PRIMARY KEY AUTOINCREMENT,
            cliente_nome TEXT,
            cliente_contato TEXT,
            data TEXT,
            validade TEXT,
            observacoes TEXT,
            total REAL
        )");
    }

    public function testExcluirExpiradosRemovesPastRecords()
    {
        global $pdo;
        $pastDate = date('Y-m-d', strtotime('-1 day'));
        $futureDate = date('Y-m-d', strtotime('+1 day'));

        $stmt = $this->pdo->prepare("INSERT INTO orcamentos (cliente_nome, cliente_contato, data, validade, observacoes, total) VALUES (?, ?, ?, ?, ?, ?)");
        $stmt->execute(['Past', 'cont', $pastDate, $pastDate, 'obs', 10]);
        $stmt->execute(['Future', 'cont', $futureDate, $futureDate, 'obs', 20]);

        Orcamento::excluirExpirados();

        $remaining = $this->pdo->query("SELECT COUNT(*) FROM orcamentos")->fetchColumn();
        $this->assertEquals(1, $remaining);

        $validDate = $this->pdo->query("SELECT validade FROM orcamentos")->fetchColumn();
        $this->assertEquals($futureDate, $validDate);
    }
}
