USE gatitos;

CREATE TABLE IF NOT EXISTS `tweets` (
`id` int(11) NOT NULL,
  `tid` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `nick` varchar(100) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=MyISAM AUTO_INCREMENT=16 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

INSERT INTO `tweets` (`id`, `tid`, `nick`) VALUES
(1, '884894716885643264', 'pepellou'),
(2, '892423893415276544', 'Gata_meow'),
(3, '897514569610010624', 'jetsvazquezjaen'),
(4, '897296967935590401', 'PuntoLontue'),
(5, '897513253391273984', 'Guiller96069619'),
(6, '897554663314268160', 'molinaaldia'),
(7, '897762376522633216', 'caba_del'),
(8, '897825418602045440', 'Llepafils12'),
(9, '897601806259429376', 'Robertofr63'),
(10, '900072802514075648', 'carlosmundy'),
(11, '916266316260167680', 'preferente'),
(12, '918936666781442048', 'kdarrey'),
(13, '921653375355293696', 'lanuevaespana'),
(14, '921880882948071424', 'esasinomais'),
(15, '917279207482445825', 'GuifrP');

ALTER TABLE `tweets` ADD PRIMARY KEY (`id`);
ALTER TABLE `tweets` MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=16;
