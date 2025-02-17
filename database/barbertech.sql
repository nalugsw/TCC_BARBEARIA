DROP DATABASE barbertech;

CREATE DATABASE barbertech;

USE barbertech;

CREATE TABLE CATALOGO (
    id_catalogo int auto_increment PRIMARY KEY,
    nome varchar(30) not null,
    valor decimal(6,2) not null,
    duracao time not null,
    foto varchar(255) null
);

CREATE TABLE CLIENTE (
    id_cliente int auto_increment PRIMARY KEY,
    nome varchar(100) not null,
    foto varchar(255) null,
    numero_telefone varchar(11) not null,
    id_usuario int
);

CREATE TABLE PRODUTO (
    id_produto int auto_increment PRIMARY KEY,
    valor decimal(6,2) not null,
    foto varchar(255) null,
    quantidade int(4) not null,
    descricao varchar(50) null,
    id_catalogo int
);

CREATE TABLE FUNCIONARIO (
    id_funcionario int auto_increment PRIMARY KEY,
    nome varchar(40) not null,
    numero_telefone varchar(11) not null,
    biografia varchar(255) null,
    foto varchar(255),
    id_usuario int
);

CREATE TABLE AGENDA (
    id_agenda int auto_increment not null PRIMARY KEY,
    data date not null,
    horario time not null,
    id_cliente int,
    id_funcionario int,
    id_catalogo int
);

CREATE TABLE USUARIO (
    id_usuario int auto_increment PRIMARY KEY,
    email varchar(80) not null,
    senha varchar(30) not null,
    tipo_usuario int
);

CREATE TABLE tipo_usuario (
    tipo_usuario int PRIMARY KEY,
    descricao varchar(10)
);
 
ALTER TABLE CLIENTE ADD CONSTRAINT fk_id_usuario1
    FOREIGN KEY (id_usuario)
    REFERENCES USUARIO (id_usuario);
 
ALTER TABLE PRODUTO ADD CONSTRAINT fk_id_catalogo2
    FOREIGN KEY (id_catalogo)
    REFERENCES CATALOGO (id_catalogo);
 
ALTER TABLE FUNCIONARIO ADD CONSTRAINT fk_id_usuario2
    FOREIGN KEY (id_usuario)
    REFERENCES USUARIO (id_usuario);
 
ALTER TABLE AGENDA ADD CONSTRAINT fk_id_cliente
    FOREIGN KEY (id_cliente)
    REFERENCES CLIENTE (id_cliente);
 
ALTER TABLE AGENDA ADD CONSTRAINT fk_id_functionario
    FOREIGN KEY (id_funcionario)
    REFERENCES FUNCIONARIO (id_funcionario);
 
ALTER TABLE AGENDA ADD CONSTRAINT fk_id_catalogo1
    FOREIGN KEY (id_catalogo)
    REFERENCES CATALOGO (id_catalogo);
 
ALTER TABLE USUARIO ADD CONSTRAINT fk_tipo_usuario
    FOREIGN KEY (tipo_usuario)
    REFERENCES tipo_usuario (tipo_usuario);