SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "-03:00";

-- Base de Dados: pizzeria

CREATE DATABASE IF NOT EXISTS pizzeria DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE pizzeria;


-- Estrutura da tabela de pizza

CREATE TABLE IF NOT EXISTS tb_pizza (
  id_pizza int NOT NULL AUTO_INCREMENT,
  pizza varchar(80) NOT NULL,
  PRIMARY KEY (id_pizza)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1;


-- Inserção dados de teste na tabela pizza

INSERT INTO tb_pizza (pizza)
		VALUES	('MARGHERITA'),
        		('PORTUGUESA'),
            ('QUEIJO');


-- Estrutura da tabela de ingredientes

CREATE TABLE IF NOT EXISTS tb_ingredient (
  id_ingredient int NOT NULL AUTO_INCREMENT,
  ingredient varchar(80) NOT NULL,
  ind_available boolean NOT NULL,	            --  TRUE - available / FALSE - not available
  PRIMARY KEY (id_ingredient)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1;


-- Inserção dados de teste na tabela de produtos

INSERT INTO tb_ingredient (ingredient, ind_available)
		VALUES	('TOMATE',      TRUE),
        		('MANJERICÃO',  TRUE),
        		('CALABRESA',	  TRUE),
        		('AZEITONA',	  TRUE),
            ('MUÇARELA',	  TRUE),
            ('CEBOLA',		  FALSE);


-- Estrutura da tabela de ingredientes da pizza

CREATE TABLE IF NOT EXISTS tb_ingredient_pizza (
  id_pizza int NOT NULL,
  id_ingredient int NOT NULL,
  PRIMARY KEY (id_pizza, id_ingredient),
  FOREIGN KEY (id_pizza)		REFERENCES tb_pizza(id_pizza),
  FOREIGN KEY (id_ingredient)	REFERENCES tb_ingredient(id_ingredient)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1;

-- Estrutura da tabela de usuarios

CREATE TABLE IF NOT EXISTS tb_membership (
  id_membership int(11) NOT NULL AUTO_INCREMENT,
  username varchar(32) NOT NULL,
  password varchar(32) NOT NULL,
  status tinyint(1) NOT NULL,
  PRIMARY KEY (id_membership)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1;

-- Inserção dados de teste na tabela de usuarios

INSERT INTO tb_membership(username, password, status)
		VALUES	('Root',    'root', 9),
            ('fulano',  '123456', 1),
        		('ciclana', '123456', 0),
            ('maria',   '123456', 2);