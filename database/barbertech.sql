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
