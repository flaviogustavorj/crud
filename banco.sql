/* Apaga a base de dados */
DROP DATABASE CRUD;

/* Cria uma base de dados */
CREATE DATABASE CRUD;

/* conecta a uma base existente */
USE CRUD;


/* Cria uma tabela chamada usuario */
CREATE TABLE usuario(
    cod int auto_increment primary key,
    nome varchar(50) not null,
    email varchar(50) not null,
    login varchar(30) not null unique,
    senha char(32) not null,
    perfil enum('adm', 'user')
)

INSERT INTO usuario VALUES(NULL, 'Flavio', 'flavio@gmail.com', 'flaviogustavo', md5('123'), 'adm')

/* Cria uma tabela chamada cliente */
CREATE TABLE cliente(

    cod int auto_increment primary key,
    nome varchar(50) not null,
    email varchar(50) not null,
    cpf char(11) not null,
    estadocivil varchar(10)

);

/*
    primary key -> não pode ser null, nem repetido;
*/