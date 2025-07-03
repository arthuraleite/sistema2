-- Database schema and sample data for the Sistema application
-- Drop existing tables
DROP TABLE IF EXISTS orcamento_itens;
DROP TABLE IF EXISTS orcamentos;
DROP TABLE IF EXISTS movimentacoes;
DROP TABLE IF EXISTS pedido_itens;
DROP TABLE IF EXISTS pedidos;
DROP TABLE IF EXISTS produtos;
DROP TABLE IF EXISTS clientes;
DROP TABLE IF EXISTS usuarios;
DROP TABLE IF EXISTS contas_recorrentes;
DROP TABLE IF EXISTS financeiro;

-- Usuarios do sistema
CREATE TABLE usuarios (
    id INT AUTO_INCREMENT PRIMARY KEY,
    usuario VARCHAR(50) NOT NULL,
    senha VARCHAR(255) NOT NULL,
    tipo VARCHAR(20) NOT NULL DEFAULT 'comum'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Clientes
CREATE TABLE clientes (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nome VARCHAR(100) NOT NULL,
    telefone VARCHAR(20),
    email VARCHAR(100),
    cpf_cnpj VARCHAR(20) UNIQUE,
    tipo VARCHAR(10),
    contato VARCHAR(100),
    responsavel VARCHAR(100),
    insc_municipal VARCHAR(50),
    insc_estadual VARCHAR(50),
    observacoes TEXT
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Produtos vendidos
CREATE TABLE produtos (
    id INT AUTO_INCREMENT PRIMARY KEY,
    descricao VARCHAR(255) NOT NULL,
    valor_unitario DECIMAL(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Pedidos realizados
CREATE TABLE pedidos (
    id INT AUTO_INCREMENT PRIMARY KEY,
    cliente_id INT NOT NULL,
    data_pedido DATE NOT NULL,
    previsao_entrega DATE NOT NULL,
    status VARCHAR(20) NOT NULL,
    observacoes TEXT,
    total DECIMAL(10,2) NOT NULL DEFAULT 0,
    FOREIGN KEY (cliente_id) REFERENCES clientes(id)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Itens dos pedidos
CREATE TABLE pedido_itens (
    id INT AUTO_INCREMENT PRIMARY KEY,
    pedido_id INT NOT NULL,
    descricao VARCHAR(255) NOT NULL,
    quantidade INT NOT NULL DEFAULT 1,
    valor_unitario DECIMAL(10,2) NOT NULL,
    subtotal DECIMAL(10,2) NOT NULL,
    FOREIGN KEY (pedido_id) REFERENCES pedidos(id) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Movimentacoes financeiras ligadas a pedidos
CREATE TABLE movimentacoes (
    id INT AUTO_INCREMENT PRIMARY KEY,
    pedido_id INT NOT NULL,
    valor DECIMAL(10,2) NOT NULL,
    descricao VARCHAR(255),
    data DATE NOT NULL,
    forma_pagamento VARCHAR(50),
    FOREIGN KEY (pedido_id) REFERENCES pedidos(id) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Orcamentos gerados para clientes
CREATE TABLE orcamentos (
    id INT AUTO_INCREMENT PRIMARY KEY,
    cliente_nome VARCHAR(100) NOT NULL,
    cliente_contato VARCHAR(100),
    data DATE NOT NULL,
    validade DATE NOT NULL,
    observacoes TEXT,
    total DECIMAL(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Itens dos orcamentos
CREATE TABLE orcamento_itens (
    id INT AUTO_INCREMENT PRIMARY KEY,
    orcamento_id INT NOT NULL,
    descricao VARCHAR(255) NOT NULL,
    quantidade INT NOT NULL DEFAULT 1,
    valor_unitario DECIMAL(10,2) NOT NULL,
    subtotal DECIMAL(10,2) NOT NULL,
    FOREIGN KEY (orcamento_id) REFERENCES orcamentos(id) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Contas recorrentes para exibicao no dashboard
CREATE TABLE contas_recorrentes (
    id INT AUTO_INCREMENT PRIMARY KEY,
    descricao VARCHAR(255) NOT NULL,
    valor DECIMAL(10,2) NOT NULL DEFAULT 0,
    proxima_data DATE NOT NULL,
    intervalo_dias INT DEFAULT 30
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Lancamentos financeiros gerais
CREATE TABLE financeiro (
    id INT AUTO_INCREMENT PRIMARY KEY,
    descricao VARCHAR(255),
    valor DECIMAL(10,2) NOT NULL,
    data DATE NOT NULL,
    tipo VARCHAR(20) DEFAULT 'saida'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Dados iniciais ----------------------------------------------

INSERT INTO usuarios (usuario, senha, tipo) VALUES
    ('admin', '$2y$10$usesomesillystringforeTeroxHu44nz6r2P7zLyMaCiQNdWofN.', 'admin');

INSERT INTO clientes (nome, telefone, email, cpf_cnpj, tipo) VALUES
    ('João da Silva', '(11)1111-1111', 'joao@example.com', '12345678901', 'cpf'),
    ('Maria Ltda.', '(11)2222-2222', 'contato@marialtda.com', '9876543210001', 'cnpj');

INSERT INTO produtos (descricao, valor_unitario) VALUES
    ('Produto A', 10.00),
    ('Produto B', 25.50),
    ('Produto C', 5.75);

-- Pedido de exemplo
INSERT INTO pedidos (cliente_id, data_pedido, previsao_entrega, status, observacoes, total) VALUES
    (1, CURDATE(), DATE_ADD(CURDATE(), INTERVAL 7 DAY), 'Em Andamento', 'Primeiro pedido', 40.50);
SET @pedido_id = LAST_INSERT_ID();
INSERT INTO pedido_itens (pedido_id, descricao, quantidade, valor_unitario, subtotal) VALUES
    (@pedido_id, 'Produto A', 2, 10.00, 20.00),
    (@pedido_id, 'Produto B', 1, 20.50, 20.50);
INSERT INTO movimentacoes (pedido_id, valor, descricao, data, forma_pagamento) VALUES
    (@pedido_id, 20.00, 'Entrada parcial', CURDATE(), 'Dinheiro');

-- Orcamento de exemplo
INSERT INTO orcamentos (cliente_nome, cliente_contato, data, validade, observacoes, total) VALUES
    ('Empresa Exemplo', 'exemplo@empresa.com', CURDATE(), DATE_ADD(CURDATE(), INTERVAL 30 DAY), 'Orçamento padrão', 100.00);
SET @orc_id = LAST_INSERT_ID();
INSERT INTO orcamento_itens (orcamento_id, descricao, quantidade, valor_unitario, subtotal) VALUES
    (@orc_id, 'Produto A', 5, 10.00, 50.00),
    (@orc_id, 'Produto B', 2, 25.00, 50.00);

INSERT INTO contas_recorrentes (descricao, valor, proxima_data) VALUES
    ('Internet', 120.00, DATE_ADD(CURDATE(), INTERVAL 10 DAY)),
    ('Energia Elétrica', 300.00, DATE_ADD(CURDATE(), INTERVAL 20 DAY));

INSERT INTO financeiro (descricao, valor, data, tipo) VALUES
    ('Compra de materiais', 200.00, CURDATE(), 'saida'),
    ('Venda avulsa', 150.00, CURDATE(), 'entrada');

