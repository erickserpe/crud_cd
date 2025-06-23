-- Criação e povoamento do banco de dados para o projeto de CDs

CREATE DATABASE IF NOT EXISTS cadastro_cds;
USE cadastro_cds;

-- --- Estrutura das tabelas ---

CREATE TABLE `cd` (
  `id` int NOT NULL AUTO_INCREMENT,
  `artista` varchar(200) DEFAULT NULL,
  `titulo` varchar(200) DEFAULT NULL,
  `descricao` text,
  `preco` double DEFAULT NULL,
  `ano` varchar(4) DEFAULT NULL,
  `estilo` varchar(50) DEFAULT NULL,
  `gravadora` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id`)
);

CREATE TABLE `musica` (
  `id` int NOT NULL AUTO_INCREMENT,
  `id_cd` int NOT NULL,
  `nome` varchar(200) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `id_cd` (`id_cd`),
  CONSTRAINT `musica_ibfk_1` FOREIGN KEY (`id_cd`) REFERENCES `cd` (`id`) ON DELETE CASCADE
);


-- --- Inserção dos dados de exemplo ---

-- Queen
insert into cd (id, artista, titulo, descricao, preco, ano, estilo, gravadora) values (1, 'Queen', 'A Night at the Opera', 'Um dos álbuns mais icônicos do Queen, famoso por "Bohemian Rhapsody".', 49.90, '1975', 'Rock', 'EMI');
insert into musica (id_cd, nome) values
(1, 'Bohemian Rhapsody'),
(1, 'Love of My Life'),
(1, 'You''re My Best Friend');

-- Legião Urbana
insert into cd (id, artista, titulo, descricao, preco, ano, estilo, gravadora) values (2, 'Legião Urbana', 'Dois', 'Segundo álbum de estúdio da banda, com grandes sucessos como "Tempo Perdido".', 42.00, '1986', 'Rock Nacional', 'EMI');
insert into musica (id_cd, nome) values
(2, 'Tempo Perdido'),
(2, 'Eduardo e Mônica'),
(2, 'Índios');

-- Caetano Veloso
insert into cd (id, artista, titulo, descricao, preco, ano, estilo, gravadora) values (3, 'Caetano Veloso', 'Transa', 'Gravado durante o exílio em Londres, um marco na carreira de Caetano.', 35.50, '1972', 'MPB', 'Philips');
insert into musica (id_cd, nome) values
(3, 'You Don''t Know Me'),
(3, 'Nine Out of Ten'),
(3, 'Triste Bahia');

-- Dua Lipa
insert into cd (id, artista, titulo, descricao, preco, ano, estilo, gravadora) values (4, 'Dua Lipa', 'Future Nostalgia', 'Álbum aclamado pela crítica com uma sonoridade disco-pop.', 89.99, '2020', 'Pop', 'Warner Records');
insert into musica (id_cd, nome) values
(4, 'Don''t Start Now'),
(4, 'Levitating'),
(4, 'Physical');

-- Cartola
insert into cd (id, artista, titulo, descricao, preco, ano, estilo, gravadora) values (5, 'Cartola', 'Cartola (1976)', 'O segundo álbum de estúdio do mestre do samba, Cartola.', 29.90, '1976', 'Samba', 'Discos Marcus Pereira');
insert into musica (id_cd, nome) values
(5, 'As Rosas Não Falam'),
(5, 'O Mundo é um Moinho');