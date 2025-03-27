create database barbertech;

use barbertech;

CREATE TABLE SERVICO (
    id_servico int auto_increment PRIMARY KEY,
    nome varchar(30) not null,
    valor decimal(6,2) not null,
    duracao time not null,
    foto varchar(255) null
);

CREATE TABLE CLIENTE (
    id_cliente int auto_increment PRIMARY KEY,
    nome varchar(100) not null,
    foto varchar(255) null,
    numero_telefone varchar(11) not null UNIQUE,
    id_usuario int
);

CREATE TABLE PRODUTO (
    id_produto int auto_increment PRIMARY KEY,
    nome varchar(30) not null,
    preco decimal(6,2) not null,
    foto varchar(255) null,
    quantidade int(4) not null,
    descricao varchar(50) null
);

CREATE TABLE FUNCIONARIO (
    id_funcionario int auto_increment PRIMARY KEY,
    nome varchar(40) not null,
    numero_telefone varchar(11) not null UNIQUE,
    biografia varchar(255) null,
    foto varchar(255) null,
    portfolio varchar(255) null,
    id_usuario int
);

CREATE TABLE AGENDA (
    id_agenda int auto_increment not null PRIMARY KEY,
    data date not null,
    horario time not null,
    id_funcionario int,
    id_cliente_servico int
);

CREATE TABLE USUARIO (
    id_usuario int auto_increment PRIMARY KEY,
    email varchar(80) not null,
    senha varchar(90) not null,
    token varchar(20) null,
    validade_token datetime null,
    status enum('verificado','pendente') not null,
    tipo_usuario varchar(20) not null
);

CREATE TABLE CLIENTE_SERVICO (
    id_cliente_servico int auto_increment PRIMARY KEY,
    id_cliente int,
    id_servico int
);

CREATE TABLE INFORMACOES(
    id_informacoes int AUTO_INCREMENT PRIMARY KEY,
    informacoes_barbeiro VARCHAR(255) NOT NULL,
    informacoes_barbearia VARCHAR(255) NOT NULL
);

CREATE TABLE PORTFOLIO(
    id_portfolio INT AUTO_INCREMENT PRIMARY KEY,
    imagem varchar(255) NOT NULL
);

-- Tabela para configurar dias e horários de funcionamento
CREATE TABLE CONFIGURACAO_HORARIO (
    id_configuracao INT AUTO_INCREMENT PRIMARY KEY,
    dia_semana ENUM('segunda', 'terca', 'quarta', 'quinta', 'sexta', 'sabado', 'domingo') NOT NULL,
    aberto BOOLEAN DEFAULT FALSE,
    hora_abertura TIME,
    hora_fechamento TIME,
    intervalo_minutos INT DEFAULT 30,
    id_funcionario INT,
    FOREIGN KEY (id_funcionario) REFERENCES FUNCIONARIO(id_funcionario)
);

-- Tabela para feriados/dias de fechamento
CREATE TABLE DIAS_FECHADOS (
    id_dia_fechado INT AUTO_INCREMENT PRIMARY KEY,
    data DATE NOT NULL,
    motivo VARCHAR(100),
    id_funcionario INT,
    FOREIGN KEY (id_funcionario) REFERENCES FUNCIONARIO(id_funcionario)
);

-- Tabela para configurações gerais da barbearia
CREATE TABLE CONFIGURACAO_BARBEARIA (
    id_configuracao INT AUTO_INCREMENT PRIMARY KEY,
    dias_antecedencia_agendamento INT DEFAULT 15,
    tempo_minimo_cancelamento INT DEFAULT 2, -- em horas
    tempo_entre_agendamentos INT DEFAULT 15 -- em minutos
);
 
ALTER TABLE CLIENTE ADD CONSTRAINT fk_id_usuario
    FOREIGN KEY (id_usuario)
    REFERENCES USUARIO (id_usuario);
 
ALTER TABLE FUNCIONARIO ADD CONSTRAINT fk_id_usuario_2
    FOREIGN KEY (id_usuario)
    REFERENCES USUARIO (id_usuario);
 
ALTER TABLE AGENDA ADD CONSTRAINT fk_id_functionario
    FOREIGN KEY (id_funcionario)
    REFERENCES FUNCIONARIO (id_funcionario);
 
ALTER TABLE AGENDA ADD CONSTRAINT fk_id_cliente_servico
    FOREIGN KEY (id_cliente_servico)
    REFERENCES CLIENTE_SERVICO (id_cliente_servico);
 
ALTER TABLE CLIENTE_SERVICO ADD CONSTRAINT fk_id_cliente
    FOREIGN KEY (id_cliente)
    REFERENCES CLIENTE (id_cliente);
 
ALTER TABLE CLIENTE_SERVICO ADD CONSTRAINT fk_id_servico
    FOREIGN KEY (id_servico)
    REFERENCES SERVICO (id_servico);

    INSERT INTO PRODUTO (nome, preco, foto, quantidade, descricao) VALUES
('Desodorante', 15.90, 'desodorante.png', 100, 'Desodorante em spray de longa duração'),
('Shampoo Hidratante', 25.50, 'shampoo_hidratante.png', 50, 'Shampoo para cabelos secos e danificados'),
('Sabonete Líquido', 7.40, 'sabonete_liquido.png', 200, 'Sabonete líquido com extrato de aloe vera'),
('Pasta de Dente', 6.30, 'pasta_de_dente.png', 150, 'Pasta de dente para proteção contra cáries'),
('Creme para Mãos', 12.80, 'creme_para_maos.png', 75, 'Creme hidratante para as mãos'),
('Condicionador Nutritivo', 19.90, 'condicionador_nutritivo.png', 120, 'Condicionador para cabelos macios e brilhantes'),
('Escova de Dente', 4.50, 'escova_de_dente.png', 180, 'Escova de dente com cerdas macias'),
('Perfume Feminino', 89.90, 'perfume_feminino.png', 30, 'Perfume floral suave para o dia a dia');

INSERT INTO SERVICO (nome, valor, duracao, foto) VALUES 
('Corte Masculino', 35.00, '00:30:00', 'corte_masculino.png'),
('Corte Infantil', 25.00, '00:30:00', 'corte_infantil.png'),
('Barba Completa', 30.00, '00:25:00', 'barba_completa.png'),
('Corte e Barba', 60.00, '01:00:00', 'corte_e_barba.png'),
('Sobrancelha', 15.00, '00:15:00', 'sobrancelha.png'),
('Luzes Masculinas', 80.00, '01:30:00', 'luzes_masculinas.png'),
('Progressiva', 120.00, '02:00:00', 'progressiva.png'),
('Hidratação Capilar', 50.00, '00:40:00', 'hidratacao_capilar.png'),
('Pigmentação de Barba', 40.00, '00:35:00', 'pigmentacao_barba.png'),
('Relaxamento Capilar', 90.00, '01:45:00', 'relaxamento_capilar.png');

INSERT INTO informacoes (informacoes_barbeiro, informacoes_barbearia)values(
    'João é barbeiro há 12 anos. Começou em uma barbearia pequena, aprendendo com mestres da área. Ao longo dos anos, se especializou em cortes modernos, barba estilizada e acabamento perfeito. Já atendeu uma grande variedade de clientes, de estilos clássicos a mais ousados. Ele também fez cursos de coloração e penteados, sempre buscando inovar. João se destaca pela atenção aos detalhes e pela forma descontraída de fazer os clientes se sentirem à vontade. Hoje, tem sua própria barbearia, onde é referência na cidade.',
    'Na Barbearia do João, tradição e estilo se encontram para oferecer a melhor experiência em cortes e barba. Nossa barbearia combina técnicas clássicas com as últimas tendências, garantindo um atendimento personalizado para cada cliente. Com anos de experiência, João e sua equipe são especialistas em cortes modernos, degradês impecáveis e barbas bem definidas.'
);

-- Configuração padrão de horários (terça a domingo, folga na segunda)
INSERT INTO CONFIGURACAO_HORARIO (dia_semana, aberto, hora_abertura, hora_fechamento, intervalo_minutos) VALUES
('segunda', FALSE, NULL, NULL, 30), -- Folga
('terca', TRUE, '09:00:00', '18:00:00', 30),
('quarta', TRUE, '09:00:00', '18:00:00', 30),
('quinta', TRUE, '09:00:00', '18:00:00', 30),
('sexta', TRUE, '09:00:00', '18:00:00', 30),
('sabado', TRUE, '08:00:00', '17:00:00', 30),
('domingo', TRUE, '10:00:00', '15:00:00', 30);

-- Alguns dias de fechamento exemplo
INSERT INTO DIAS_FECHADOS (data, motivo) VALUES
('2023-12-25', 'Natal'),
('2024-01-01', 'Ano Novo'),
('2024-04-21', 'Tiradentes');

-- Configurações gerais da barbearia
INSERT INTO CONFIGURACAO_BARBEARIA (dias_antecedencia_agendamento, tempo_minimo_cancelamento, tempo_entre_agendamentos) VALUES
(15, 2, 15);

-- Inserir um funcionário exemplo
INSERT INTO USUARIO (email, senha, status, tipo_usuario) VALUES
('barbeiro@example.com', SHA2('senha123', 256), 'verificado', 'funcionario');

INSERT INTO FUNCIONARIO (nome, numero_telefone, biografia, id_usuario) VALUES
('Luis Pereira', '11987654321', 'Barbeiro profissional com 10 anos de experiência', LAST_INSERT_ID());

