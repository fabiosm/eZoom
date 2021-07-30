-- --------------------------------------------------------
-- Servidor:                     127.0.0.1
-- Versão do servidor:           10.4.18-MariaDB - mariadb.org binary distribution
-- OS do Servidor:               Win64
-- HeidiSQL Versão:              11.3.0.6295
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


-- Copiando estrutura do banco de dados para ezoom
CREATE DATABASE IF NOT EXISTS `ezoom` /*!40100 DEFAULT CHARACTER SET latin1 */;
USE `ezoom`;

-- Copiando estrutura para tabela ezoom.ocupacao
CREATE TABLE IF NOT EXISTS `ocupacao` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `idPersonagem` int(10) unsigned NOT NULL,
  `ocupacao` varchar(300) NOT NULL,
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`),
  KEY `FK__personagens` (`idPersonagem`),
  CONSTRAINT `FK__personagens` FOREIGN KEY (`idPersonagem`) REFERENCES `personagens` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=894 DEFAULT CHARSET=latin1;

-- Copiando dados para a tabela ezoom.ocupacao: ~0 rows (aproximadamente)
DELETE FROM `ocupacao`;
/*!40000 ALTER TABLE `ocupacao` DISABLE KEYS */;
/*!40000 ALTER TABLE `ocupacao` ENABLE KEYS */;

-- Copiando estrutura para tabela ezoom.personagens
CREATE TABLE IF NOT EXISTS `personagens` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `nome` varchar(150) DEFAULT NULL,
  `img` varchar(300) DEFAULT NULL,
  `status` varchar(100) DEFAULT NULL,
  `aniversario` date DEFAULT NULL,
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=808 DEFAULT CHARSET=latin1;

-- Copiando dados para a tabela ezoom.personagens: ~0 rows (aproximadamente)
DELETE FROM `personagens`;
/*!40000 ALTER TABLE `personagens` DISABLE KEYS */;
/*!40000 ALTER TABLE `personagens` ENABLE KEYS */;

/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
