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
    token varchar(5) null,
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
    informacoes_barbeiro TEXT NOT NULL,
    informacoes_barbearia TEXT NOT NULL
);

CREATE TABLE PORTFOLIO(
    id_portfolio INT AUTO_INCREMENT PRIMARY KEY,
    imagem varchar(255) NOT NULL
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
('Corte Masculino', 35.00, '00:30:00', 'uploads/servicos/corte-masculino.png'),
('Corte Infantil', 25.00, '00:30:00', 'uploads/servicos/corte_infantil.jpg'),
('Barba Completa', 30.00, '00:25:00', 'uploads/servicos/barba_completa.jpg'),
('Corte e Barba', 60.00, '01:00:00', 'uploads/servicos/corte_e_barba.jpg'),
('Sobrancelha', 15.00, '00:15:00', 'uploads/servicos/sobrancelha.jpg'),
('Luzes Masculinas', 80.00, '01:30:00', 'uploads/servicos/luzes_masculinas.jpg'),
('Progressiva', 120.00, '02:00:00', 'uploads/servicos/progressiva.png'),
('Hidratação Capilar', 50.00, '00:40:00', 'uploads/servicos/hidratacao_capilar.png'),
('Pigmentação de Barba', 40.00, '00:35:00', 'uploads/servicos/pigmentacao_barba.jpg'),
('Relaxamento Capilar', 90.00, '01:45:00', 'uploads/servicos/relaxamento_capilar.jpg');

INSERT INTO informacoes (informacoes_barbeiro, informacoes_barbearia)values(
    'João é barbeiro há 12 anos. Começou em uma barbearia pequena, aprendendo com mestres da área. Ao longo dos anos, se especializou em cortes modernos, barba estilizada e acabamento perfeito. Já atendeu uma grande variedade de clientes, de estilos clássicos a mais ousados. Ele também fez cursos de coloração e penteados, sempre buscando inovar. João se destaca pela atenção aos detalhes e pela forma descontraída de fazer os clientes se sentirem à vontade. Hoje, tem sua própria barbearia, onde é referência na cidade.',
    'Na Barbearia do João, tradição e estilo se encontram para oferecer a melhor experiência em cortes e barba. Nossa barbearia combina técnicas clássicas com as últimas tendências, garantindo um atendimento personalizado para cada cliente. Com anos de experiência, João e sua equipe são especialistas em cortes modernos, degradês impecáveis e barbas bem definidas.'
);





-- Inserir um funcionário exemplo
INSERT INTO USUARIO (email, senha, status, tipo_usuario) VALUES
('barbeiro@example.com', SHA2('senha123', 256), 'verificado', 'funcionario');

INSERT INTO FUNCIONARIO (nome, numero_telefone, biografia, id_usuario) VALUES
('Luis Pereira', '11987654321', 'Barbeiro profissional com 10 anos de experiência', LAST_INSERT_ID());

INSERT INTO PORTFOLIO (imagem) VALUES
('macaquinho.jpg'),
('macaquinho2.jpg'),
('macaquinho3.jpg'),
('macaquinho4.jpg'),
('macaquinho5.jpg'),
('macaquinho6.jpg'),
('macaquinho7.jpg'),
('macaquinho8.jpg'),
('macaquinho9.jpg'),
('macaquinho10.jpg'),
('macaquinho11.jpg'),
('macaquinho12.jpg'),
('macaquinho13.jpg'),
('macaquinho14.jpg');

CREATE TABLE dias_inativos (
    id INT AUTO_INCREMENT PRIMARY KEY,
    data_inativa DATE NOT NULL UNIQUE,
    motivo VARCHAR(255)
);



-- COMANDO PARA AGRUPAR OS AGENDAMENTOS POR MêS (IMPORTANTE TESTAR APÓS NALU FAZER O GRÁFICO EM JS)

-- SELECT
-- 	MONTH(data) AS mes, 
-- 	COUNT(id_agenda) AS total_agendamentos
-- FROM agenda
-- 	WHERE YEAR(data) = ?
-- 	GROUP BY MONTH(data)
-- 	ORDER BY mes;


