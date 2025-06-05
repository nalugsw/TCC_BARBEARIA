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
    ativo int(1) not null,
    descricao varchar(50) null
);

CREATE TABLE FUNCIONARIO (
    id_funcionario int auto_increment PRIMARY KEY,
    nome varchar(40) not null,
    numero_telefone varchar(11) not null UNIQUE,
    biografia varchar(255) null,
    foto varchar(255) null,
    id_usuario int
);

CREATE TABLE AGENDA (
    id_agenda int auto_increment not null PRIMARY KEY,
    data date not null,
    horario time not null,
    id_funcionario int,
    id_cliente_servico int,
    status_agenda VARCHAR(255) NOT NULL
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
    informacoes_barbearia TEXT NOT NULL,
    endereco VARCHAR(255) NOT NULL
);

CREATE TABLE portfolio(
    id_portfolio INT AUTO_INCREMENT PRIMARY KEY,
    imagem varchar(255) NOT NULL
);

CREATE TABLE horarios_disponiveis (
  id INT AUTO_INCREMENT PRIMARY KEY,
  horario TIME NOT NULL
);

CREATE TABLE dias_inativos (
    id INT AUTO_INCREMENT PRIMARY KEY,
    data_inativa DATE NOT NULL UNIQUE,
    motivo VARCHAR(255)
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

    INSERT INTO PRODUTO (nome, preco, foto, ativo, descricao) VALUES
('Desodorante', 15.90, 'uploads/produtos/desodorante.jpg', 1, 'Desodorante em spray de longa duração'),
('Shampoo Hidratante', 25.50, 'uploads/produtos/shampoo.png', 1, 'Shampoo para cabelos secos e danificados'),
('creme nutritivo', 7.40, 'uploads/produtos/creme.png', 1, 'creme com extrato de aloe vera'),
('barbeador profissional', 6.30, 'uploads/produtos/barbeador.png', 1, 'lamina de corte profissional'),
('minoxidil', 12.80, 'uploads/produtos/minoxidil.jpeg', 1, 'super minoxidil para barba e cabelo '),
('kit barba', 19.90, 'uploads/produtos/kitBarba.jpeg', 0, 'kit util para cuidados da barba'),
('tesoura sem ponta', 4.50, 'uploads/produtos/tesoura.jpg', 1, 'tesoura sem ponta para cortes simples'),
('pente simples', 89.90, 'uploads/produtos/pente.png', 0, 'pente de alta qualidade');

INSERT INTO SERVICO (nome, valor, duracao, foto) VALUES 
('Corte Masculino', 35.00, '00:30:00', 'uploads/servicos/corte-masculino.png'),
('Corte Infantil', 25.00, '00:30:00', 'uploads/servicos/corte-infantil.jpg'),
('Barba Completa', 30.00, '00:25:00', 'uploads/servicos/barba_completa.jpg'),
('Corte e Barba', 60.00, '01:00:00', 'uploads/servicos/corte_e_barba.jpg'),
('Sobrancelha', 15.00, '00:15:00', 'uploads/servicos/sobrancelha.jpg'),
('Luzes Masculinas', 80.00, '01:30:00', 'uploads/servicos/luzes_masculinas.jpg'),
('Progressiva', 120.00, '02:00:00', 'uploads/servicos/progressiva.png'),
('Hidratação Capilar', 50.00, '00:40:00', 'uploads/servicos/hidratacao_capilar.png'),
('Pigmentação de Barba', 40.00, '00:35:00', 'uploads/servicos/pigmentacao_barba.jpg'),
('Relaxamento Capilar', 90.00, '01:45:00', 'uploads/servicos/relaxamento_capilar.jpg');

INSERT INTO informacoes (informacoes_barbeiro, informacoes_barbearia, endereco)values(
    'João é barbeiro há 12 anos. Começou em uma barbearia pequena, aprendendo com mestres da área. Ao longo dos anos, se especializou em cortes modernos, barba estilizada e acabamento perfeito. Já atendeu uma grande variedade de clientes, de estilos clássicos a mais ousados. Ele também fez cursos de coloração e penteados, sempre buscando inovar. João se destaca pela atenção aos detalhes e pela forma descontraída de fazer os clientes se sentirem à vontade. Hoje, tem sua própria barbearia, onde é referência na cidade.',
    'Na Barbearia do João, tradição e estilo se encontram para oferecer a melhor experiência em cortes e barba. Nossa barbearia combina técnicas clássicas com as últimas tendências, garantindo um atendimento personalizado para cada cliente. Com anos de experiência, João e sua equipe são especialistas em cortes modernos, degradês impecáveis e barbas bem definidas.',
    'Rua seilaoqueénois 994, Jardim sua Tia corna São paulo - SP'
);





-- Inserir um funcionário exemplo
INSERT INTO USUARIO (email, senha, status, tipo_usuario) VALUES
('barbeiro@example.com', SHA2('senha123', 256), 'verificado', 'funcionario');

INSERT INTO FUNCIONARIO (nome, numero_telefone, biografia, id_usuario) VALUES
('Luis Pereira', '11987654321', 'Barbeiro profissional com 10 anos de experiência', LAST_INSERT_ID());

INSERT INTO PORTFOLIO (imagem) VALUES
('fotocabelo.jpg'),
('fotocabelo2.jpg'),
('fotocabelo3.jpg'),
('fotocabelo4.jpg'),
('fotocabelo5.jpg'),
('fotocabelo6.jpg'),
('fotocabelo7.jpg'),
('fotocabelo8.jpg'),
('fotocabelo9.jpg'),
('fotocabelo10.jpg');

--INSERT DE USUARIO ADMIN PARA TESTE
INSERT INTO usuario (email, senha, status, tipo_usuario) VALUES
('admin@gmail.com', '$2y$10$P6Bif0wy/RL.LMHOsy1oo.dI4XWBP9arKmwHHDySuuRjYakjodB/u', 'verificado', 'administrador');
--SENHA: 123456789


--INSERT DE USUARIO FUNCIONARIO PARA TESTE
INSERT INTO usuario (email, senha, status, tipo_usuario) VALUES
('barbeiro@gmail.com', '$2y$10$y6Dmzy51zweP4GuOb66T1eaoNNDJp3ixw81iLbzRwfZGbcKw0Rs7i', 'verificado', 'funcionario');
--SENHA: barbeiro123


--INSERT DOS HORÁRIOS DISPONÍVEIS DA AGENDA
INSERT INTO horarios_disponiveis (horario) VALUES
('08:00:00'), ('08:30:00'), ('09:00:00'), ('10:00:00'), ('11:00:00'),
('14:00:00'), ('15:00:00'), ('16:00:00'), ('17:00:00'), ('18:00:00');




-- COMANDO PARA TRAZER OS DADOS PARA A PAGINA DE FUNCIONARIO/ADMIN
-- SELECT 
--     c.nome AS nome_cliente,
--     c.numero_telefone AS telefone_cliente,
--     s.nome AS servico_agendado,
--     a.data AS data_agendamento,
--     a.horario AS horario_agendamento,
--     c.foto AS foto_cliente
-- FROM 
--     AGENDA a
-- JOIN 
--     CLIENTE_SERVICO cs ON a.id_cliente_servico = cs.id_cliente_servico
-- JOIN 
--     CLIENTE c ON cs.id_cliente = c.id_cliente
-- JOIN 
--     SERVICO s ON cs.id_servico = s.id_servico
-- ORDER BY 
--     a.data, 
--     a.horario;