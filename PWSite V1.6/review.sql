CREATE TABLE IF NOT EXISTS `review` (
  `id_review` int(6) NOT NULL AUTO_INCREMENT,
  `id_jogos` int(6) NOT NULL,
  `user_id` int(6) NOT NULL,
  `nome` varchar(30) NOT NULL,
  `score` int(6) NOT NULL,
  `comentario` varchar(300) NOT NULL,
  PRIMARY KEY (`id_review`),
  Foreign key(id_jogos) references jogos(id_jogos),
  Foreign key(user_id) references users(user_id));