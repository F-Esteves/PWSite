CREATE TABLE IF NOT EXISTS `jogos` (
  `id_jogos` int(6) NOT NULL AUTO_INCREMENT,
  `nome` varchar(30) NOT NULL,
  `url` varchar(100) NOT NULL,
  PRIMARY KEY (`id_jogos`)
) ENGINE=InnoDB CHARSET=utf8;



INSERT INTO `jogos` (`id_jogos`, `nome`, `url`) VALUES
('','Cyberpunk_2077', 'https://upload.wikimedia.org/wikipedia/pt/f/f7/Cyberpunk_2077_capa.png' ),
('','Halo_TMCC','https://upload.wikimedia.org/wikipedia/pt/a/a2/Halo_TMCC_KeyArt_Vert_2019_Final.jpg'),
('','Assassins_Creed_Valhalla','https://upload.wikimedia.org/wikipedia/pt/e/e9/Assassins_Creed_Valhalla_capa.png')




