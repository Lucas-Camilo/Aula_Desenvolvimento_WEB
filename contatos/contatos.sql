-- Apaga o banco contatos se existir
DROP DATABASE IF EXISTS contatos;
-- Cria o banco contatos se não existir
CREATE DATABASE IF NOT EXISTS contatos;
-- Abre o banco contatos
USE contatos;
-- Cria a tabela usuario
CREATE TABLE usuario (
usuario varchar(08) NOT NULL PRIMARY KEY,
senha   varchar(60) NOT NULL,
nome    varchar(50) NOT NULL,
cat     varchar(02) NOT NULL);
insert into usuario values
('admin', SHA1('abc'), 'Administrador', '00'),
('usu01', SHA1('abc'), 'Usuário 01', '01');