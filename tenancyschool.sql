-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: 08-Abr-2020 às 18:46
-- Versão do servidor: 10.1.9-MariaDB
-- PHP Version: 5.6.15

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `tenancyschool`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `licences`
--

CREATE TABLE `licences` (
  `id_licence` int(11) NOT NULL,
  `licence_cod` varchar(30) NOT NULL,
  `statu` varchar(5) NOT NULL,
  `validad` varchar(6) DEFAULT NULL,
  `uses` varchar(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `licences`
--

INSERT INTO `licences` (`id_licence`, `licence_cod`, `statu`, `validad`, `uses`) VALUES
(4, 'NA004598-34764', 'on', '2019', 'sim'),
(5, 'PA004598-34765', 'on', '2019', 'nao'),
(7, 'NA004578-34781', 'on', '2019', 'nao'),
(9, 'PA004595-34709', 'on', '2019', 'sim');

-- --------------------------------------------------------

--
-- Estrutura da tabela `schools`
--

CREATE TABLE `schools` (
  `id_school` varchar(20) NOT NULL,
  `id_licence` int(11) NOT NULL,
  `nome` varchar(80) NOT NULL,
  `province` varchar(50) NOT NULL,
  `city` varchar(80) DEFAULT NULL,
  `distrit` varchar(40) NOT NULL,
  `dbname` varchar(70) NOT NULL,
  `logo_image` varchar(200) DEFAULT NULL,
  `phone` varchar(15) NOT NULL,
  `date_cad` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `schools`
--

INSERT INTO `schools` (`id_school`, `id_licence`, `nome`, `province`, `city`, `distrit`, `dbname`, `logo_image`, `phone`, `date_cad`) VALUES
('na004598', 4, 'Liceu Welwitchia Mirabilis 001', 'Namibe', 'Namibe', 'Eucaliptos', 'tenancyschool_na004598', 'none.jpg', '926164222', '2020-04-03'),
('pa004595', 9, 'Liceu Welwitchia Mirabilis 002', 'Namibe', 'Namibe', 'Eucaliptos', 'tenancyschool_pa004595', 'none.jpg', '923290392', '2020-04-08');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `licences`
--
ALTER TABLE `licences`
  ADD PRIMARY KEY (`id_licence`),
  ADD UNIQUE KEY `licence_cod` (`licence_cod`);

--
-- Indexes for table `schools`
--
ALTER TABLE `schools`
  ADD PRIMARY KEY (`id_school`),
  ADD KEY `fk_id_school` (`id_licence`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `licences`
--
ALTER TABLE `licences`
  MODIFY `id_licence` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
--
-- Constraints for dumped tables
--

--
-- Limitadores para a tabela `schools`
--
ALTER TABLE `schools`
  ADD CONSTRAINT `fk_id_school` FOREIGN KEY (`id_licence`) REFERENCES `licences` (`id_licence`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
