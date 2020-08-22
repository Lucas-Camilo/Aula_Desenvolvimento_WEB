DROP DATABASE IF EXISTS contatos;
CREATE DATABASE IF NOT EXISTS contatos;
USE contatos;
CREATE TABLE usuario (
usuario varchar(08) NOT NULL PRIMARY KEY,
senha   varchar(60) NOT NULL,
nome    varchar(50) NOT NULL,
cat     varchar(02) NOT NULL);
insert into usuario values
('admin', SHA1('abc'), 'Administrador', '00'),
('usu01', SHA1('abc'), 'Usuário 01', '01');