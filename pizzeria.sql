SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "-03:00";

-- Base de Dados: pizzeria

CREATE DATABASE IF NOT EXISTS pizzeria DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE pizzeria;


-- Estrutura da tabela de pizza

CREATE TABLE IF NOT EXISTS tb_pizza (
  id_pizza          INT NOT NULL AUTO_INCREMENT,
  pizza             VARCHAR(80) NOT NULL,
  price             DECIMAL(5, 2) NOT NULL,  PRIMARY KEY (id_pizza)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1;


-- Inserção dados de teste na tabela pizza

INSERT INTO tb_pizza (pizza, price)
 		VALUES	('MARGHERITA', 40),
         		('PORTUGUESA', 43.5),
            ('QUEIJO', 38.5);


-- Estrutura da tabela de ingredientes

CREATE TABLE IF NOT EXISTS tb_ingredient (
  id_ingredient     INT NOT NULL AUTO_INCREMENT,
  ingredient        VARCHAR(80) NOT NULL,
  ind_available     BOOLEAN NOT NULL,	            --  TRUE - available / FALSE - not available
  PRIMARY KEY       (id_ingredient)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1;


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
  id_pizza          INT NOT NULL,
  id_ingredient     INT NOT NULL,
  PRIMARY KEY       (id_pizza, id_ingredient),
  FOREIGN KEY       (id_pizza)		REFERENCES tb_pizza(id_pizza),
  FOREIGN KEY       (id_ingredient)	REFERENCES tb_ingredient(id_ingredient)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1;

-- Estrutura da tabela de usuarios

CREATE TABLE IF NOT EXISTS tb_membership (
  id_membership     INT(11) NOT NULL AUTO_INCREMENT,
  username          VARCHAR(32) NOT NULL,
  password          VARCHAR(32) NOT NULL,
  status            tinyint(1) NOT NULL,
  PRIMARY KEY       (id_membership)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1;

-- Inserção dados de teste na tabela de usuarios

INSERT INTO tb_membership(username, password, status)
		VALUES	('Root',    'root', 9),
            ('fulano',  '123456', 1),
        		('ciclana', '123456', 0),
            ('maria',   '123456', 2);

-- Estrutura da tabela de pedidos

CREATE TABLE IF NOT EXISTS tb_order (
  id_order        INT NOT NULL AUTO_INCREMENT,
  id_client       INT,
  name_client     VARCHAR(66) NOT NULL,
  mobile_client   INT NOT NULL,
  message_client  VARCHAR(100),
  cep             INT NOT NULL,
  rua             VARCHAR(200) NOT NULL,
  nro             VARCHAR(10),
  complemento     VARCHAR(200),
  bairro          VARCHAR(100) NOT NULL,
  cidade          VARCHAR(100) NOT NULL,
  uf              VARCHAR(2) NOT NULL,
  date_order      DATETIME NOT NULL,
  PRIMARY KEY     (id_order)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1;

-- Estrutura da tabela de itens do pedido

CREATE TABLE IF NOT EXISTS tb_items_order (
  internal_id     int NOT NULL AUTO_INCREMENT,
  id_order        int NOT NULL,
  id_item         int NOT NULL,
  desc_item       varchar(80) NOT NULL,
  price_item      DECIMAL(5, 2) NOT NULL,
  PRIMARY KEY     (internal_id),
  FOREIGN KEY     (id_order) REFERENCES tb_order(id_order)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1;
