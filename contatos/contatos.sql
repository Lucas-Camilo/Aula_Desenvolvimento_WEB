DROP DATABASE IF EXISTS contatos;

CREATE DATABASE IF NOT EXISTS contatos;

USE contatos;

CREATE TABLE usuario (
  usuario varchar(08) NOT NULL PRIMARY KEY,
  senha varchar(60) NOT NULL,
  nome varchar(50) NOT NULL,
  cat varchar(02) NOT NULL
) ENGINE = MyISAM DEFAULT CHARSET = latin1;

INSERT INTO
  usuario ('usuario', 'senha', 'nome', 'cat')
VALUES
  ('admin', SHA1('abc'), 'Administrador', '00'),
  ('usu01', SHA1('abc'), 'Usuário 01', '01');

CREATE TABLE IF NOT EXISTS tipo(
  idt varchar(2) NOT NULL,
  nomet varchar(30) NOT NULL,
  PRIMARY KEY (idt)
) DEFAULT CHARSET = latin1;

INSERT INTO
  tipo (idt, nomet)
VALUES
  ('cm', 'Comum'),
  ('pc', 'Parceiro'),
  ('fc', 'Funcionário');

Tabela contato
CREATE TABLE IF NOT EXISTS `contato` (
  `idc` BIGINT NOT NULL AUTO_INCREMENT,
  `nomec` varchar(60) NOT NULL,
  `emailc` varchar(60) NOT NULL,
  `tipoc` varchar(2) NOT NULL,
  PRIMARY KEY (`idc`),
  FOREIGN KEY (tipoc) REFERENCES tipo(idt) ON DELETE CASCADE
) DEFAULT CHARSET = latin1;

INSERT INTO
  `contato` (`idc`, `nomec`, `emailc`, `tipoc`)
VALUES
  (null, 'João', 'joao@gmail.com', 'cm'),
  (null, 'Maria', 'maria@hotmail.com', 'pc'),
  (null, 'Carlos', 'carlos@terra.com.br', 'cm'),
  (null, 'Paulo', 'paulo@gmail.com', 'cm'),
  (null, 'Marcos', 'marcos@hotmail.com', 'pc'),
  (null, 'Ana', 'ana@hotmail.com', 'fc'),
  (null, 'José', 'jose@terra.com.br', 'cm'),
  (null, 'Sonia', 'sonia@gmail.com', 'fc');