-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: 12-Abr-2020 às 16:14
-- Versão do servidor: 10.1.9-MariaDB
-- PHP Version: 5.6.15

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `00tenancyschool`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `tbl_avaliacao`
--

CREATE TABLE `tbl_avaliacao` (
  `id_avaliacao` bigint(20) NOT NULL,
  `id_estudante` int(11) NOT NULL,
  `id_disciplina` int(11) NOT NULL,
  `epoca` int(11) NOT NULL,
  `valor1` decimal(4,2) DEFAULT NULL,
  `data_valor1` date DEFAULT NULL,
  `valor2` decimal(4,2) DEFAULT NULL,
  `data_valor2` date DEFAULT NULL,
  `valor3` decimal(4,2) DEFAULT NULL,
  `data_valor3` date DEFAULT NULL,
  `ano_lectivo` int(6) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estrutura da tabela `tbl_bloqueios`
--

CREATE TABLE `tbl_bloqueios` (
  `epoca` varchar(50) NOT NULL,
  `estado` varchar(5) NOT NULL,
  `data_modificacao` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `tbl_bloqueios`
--

INSERT INTO `tbl_bloqueios` (`epoca`, `estado`, `data_modificacao`) VALUES
('1 trimestre', 'on', NULL),
('2 trimestre', 'on', NULL),
('3 trimestre', 'on', NULL),
('final', 'on', NULL);

-- --------------------------------------------------------

--
-- Estrutura da tabela `tbl_cargo`
--

CREATE TABLE `tbl_cargo` (
  `id_cargo` int(11) NOT NULL,
  `cargo` varchar(80) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `tbl_cargo`
--

INSERT INTO `tbl_cargo` (`id_cargo`, `cargo`) VALUES
(1, 'nenhum'),
(2, 'Professor efectivo'),
(3, 'Professor colaborador'),
(4, 'Director'),
(5, 'Sub-Director'),
(6, 'SeguranÃ§a'),
(7, 'Empregado(a) Limpeza');

-- --------------------------------------------------------

--
-- Estrutura da tabela `tbl_classe`
--

CREATE TABLE `tbl_classe` (
  `id_classe` int(11) NOT NULL,
  `id_curso` int(11) NOT NULL,
  `classe` varchar(80) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `tbl_classe`
--

INSERT INTO `tbl_classe` (`id_classe`, `id_curso`, `classe`) VALUES
(1, 1, 'nenhum');

-- --------------------------------------------------------

--
-- Estrutura da tabela `tbl_componente`
--

CREATE TABLE `tbl_componente` (
  `id_componente` int(11) NOT NULL,
  `componente` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `tbl_componente`
--

INSERT INTO `tbl_componente` (`id_componente`, `componente`) VALUES
(1, 'nenhum'),
(2, 'SÃ³cio Cultural'),
(3, 'CientÃ­fica'),
(4,'FormaÃ§Ã£o EspecÃ­fica'),
(5,'FormaÃ§Ã£o Geral'),
(6,'OpÃ§Ãµes');

-- --------------------------------------------------------

--
-- Estrutura da tabela `tbl_curso`
--

CREATE TABLE `tbl_curso` (
  `id_curso` int(11) NOT NULL,
  `id_ensino` int(11) NOT NULL,
  `nome_curso` varchar(80) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `tbl_curso`
--

INSERT INTO `tbl_curso` (`id_curso`, `id_ensino`, `nome_curso`) VALUES
(1, 1, 'nenhum');

-- --------------------------------------------------------

--
-- Estrutura da tabela `tbl_desistencias`
--

CREATE TABLE `tbl_desistencias` (
  `id_desistencia` int(11) NOT NULL,
  `id_pessoa` int(11) NOT NULL,
  `id_tipo_desistencia` int(11) NOT NULL,
  `motivo` varchar(100) NOT NULL,
  `data_desistencia` date NOT NULL,
  `ano_lectivo` int(6) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estrutura da tabela `tbl_director`
--

CREATE TABLE `tbl_director` (
  `id_director` bigint(20) NOT NULL,
  `id_funcionario` int(11) NOT NULL,
  `id_turma` int(11) NOT NULL,
  `ano_lectivo` int(6) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estrutura da tabela `tbl_disccurso`
--

CREATE TABLE `tbl_disccurso` (
  `id_disccurso` bigint(20) NOT NULL,
  `id_curso` int(11) NOT NULL,
  `id_disciplina` int(11) NOT NULL,
  `id_classe` int(11) NOT NULL,
  `id_epocaDis` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estrutura da tabela `tbl_disciplina`
--

CREATE TABLE `tbl_disciplina` (
  `id_disciplina` int(11) NOT NULL,
  `id_componente` int(11) NOT NULL,
  `nome_disciplina` varchar(200) NOT NULL,
  `sigla` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estrutura da tabela `tbl_ensino`
--

CREATE TABLE `tbl_ensino` (
  `id_ensino` int(11) NOT NULL,
  `ensino` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `tbl_ensino`
--

INSERT INTO `tbl_ensino` (`id_ensino`, `ensino`) VALUES
(1, 'nenhum'),
(2, 'PrimÃ¡rio & I CÃ­clo (ini . 9)'),
(3, 'FormaÃ§Ã£o TÃ©cnico Profissional(10 . 13)'),
(4, 'SecundÃ¡rio & II CÃ­clo (10 . 13)'),
(5, 'Superior');

-- --------------------------------------------------------

--
-- Estrutura da tabela `tbl_epocadis`
--

CREATE TABLE `tbl_epocadis` (
  `id_epocaDis` int(11) NOT NULL,
  `tipo` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `tbl_epocadis`
--

INSERT INTO `tbl_epocadis` (`id_epocaDis`, `tipo`) VALUES
(1, 'Anual'),
(2, '1 Semestre'),
(3, '2 Semestre');

-- --------------------------------------------------------

--
-- Estrutura da tabela `tbl_escalao`
--

CREATE TABLE `tbl_escalao` (
  `id_escalao` int(11) NOT NULL,
  `nome_escalao` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `tbl_escalao`
--

INSERT INTO `tbl_escalao` (`id_escalao`, `nome_escalao`) VALUES
(1, 'nenhum'),
(5, 'PEPD 6Âº E'),
(6, 'PIICESD 6Âº E'),
(7, 'PEPAUX 6Âº E'),
(8, 'PICESD 6Âº E'),
(9, 'PIICESD 8Âº E'),
(10, 'PIICESD 7Âº E'),
(11, 'PEPD 5Âº E'),
(12, 'PICESD 5Âº E');

-- --------------------------------------------------------

--
-- Estrutura da tabela `tbl_estudante`
--

CREATE TABLE `tbl_estudante` (
  `id_estudante` int(11) NOT NULL,
  `id_pessoa` int(11) NOT NULL,
  `id_curso` int(11) NOT NULL,
  `id_classe` int(11) NOT NULL,
  `id_turma` int(11) DEFAULT NULL,
  `data_cadastro` date NOT NULL,
  `data_modificacao` date DEFAULT NULL,
  `estadoE` int(11) DEFAULT NULL,
  `ano_lectivo` int(6) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estrutura da tabela `tbl_faltasal`
--

CREATE TABLE `tbl_faltasal` (
  `id_faltaAl` bigint(20) NOT NULL,
  `id_estudante` int(11) NOT NULL,
  `id_disciplina` int(11) NOT NULL,
  `id_tipo_falta` bigint(20) NOT NULL,
  `data_marcacao` date NOT NULL,
  `estado` varchar(6) NOT NULL,
  `ano_lectivo` int(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estrutura da tabela `tbl_faltaspr`
--

CREATE TABLE `tbl_faltaspr` (
  `id_faltaPr` bigint(20) NOT NULL,
  `id_funcionario` int(11) NOT NULL,
  `id_tipo_falta` bigint(20) NOT NULL,
  `data_marcacao` date NOT NULL,
  `estado` varchar(6) NOT NULL,
  `ano_lectivo` int(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estrutura da tabela `tbl_funcionario`
--

CREATE TABLE `tbl_funcionario` (
  `id_funcionario` int(11) NOT NULL,
  `id_pessoa` int(11) NOT NULL,
  `id_cargo` int(11) NOT NULL,
  `id_escalao` int(11) DEFAULT NULL,
  `agente` varchar(20) DEFAULT NULL,
  `data_cadastro` date NOT NULL,
  `data_modificacao` date DEFAULT NULL,
  `estadoF` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `tbl_funcionario`
--

INSERT INTO `tbl_funcionario` (`id_funcionario`, `id_pessoa`, `id_cargo`, `id_escalao`, `agente`, `data_cadastro`, `data_modificacao`, `estadoF`) VALUES
(1, 1, 4, 1, '', '2019-08-12', NULL, 0);

-- --------------------------------------------------------

--
-- Estrutura da tabela `tbl_historico`
--

CREATE TABLE `tbl_historico` (
  `id_historico` bigint(20) NOT NULL,
  `id_estudante` int(11) NOT NULL,
  `id_turma` int(11) DEFAULT NULL,
  `estado` varchar(20) DEFAULT NULL,
  `estadoH` int(11) DEFAULT NULL,
  `ano_lectivo` int(6) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estrutura da tabela `tbl_horario`
--

CREATE TABLE `tbl_horario` (
  `id_horario` int(11) NOT NULL,
  `id_hora` int(11),
  `id_semana` int(11),
  `id_disciplina` int(11) NOT NULL,
  `id_turma` int(11) NOT NULL,
  `id_sala` int(11) NOT NULL,
  `id_funcionario` int(11) NOT NULL,
  `ano_lectivo` int(6) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estrutura da tabela `tbl_municipio`
--

CREATE TABLE `tbl_municipio` (
  `id_municipio` int(11) NOT NULL,
  `id_provincia` int(11) DEFAULT NULL,
  `municipio` varchar(90) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `tbl_municipio`
--

INSERT INTO `tbl_municipio` (`id_municipio`, `id_provincia`, `municipio`) VALUES
(1, 7, 'MoÃ§amedes'),
(2, 7, 'Tombwa'),
(3, 7, 'Bibala'),
(4, 7, 'Virei'),
(5, 7, 'Camucuio'),
(6, 7, 'Lucira'),
(8, 13, 'Lubango'),
(9, 13, 'Matala'),
(10, 13, 'Humpata'),
(11, 13, 'Quipungo'),
(12, 13, 'Chibia'),
(13, 13, 'Chicomba'),
(14, 13, 'Cuvango'),
(15, 13, 'Caconda'),
(16, 13, 'Chipindo'),
(17, 13, 'Quilengues'),
(18, 13, 'Cacula'),
(19, 13, 'Jamba'),
(20, 13, 'Caluquembe'),
(21, 13, 'Chiange'),
(22, 4, 'Caxito'),
(23, 4, 'Ambriz'),
(24, 4, 'Bula Atumba'),
(25, 4, 'Dande'),
(26, 4, 'Dembos'),
(27, 4, 'Ãcolo e Bengo'),
(28, 4, 'Nambuangongo'),
(29, 4, 'Pango AluquÃ©m'),
(30, 4, 'QuiÃ§ama'),
(31, 1, 'Benguela'),
(32, 1, 'BaÃ­a Farta'),
(33, 1, 'Balombo'),
(34, 1, 'Bocoio'),
(35, 1, 'Caimbambo'),
(36, 1, 'Chongoroi'),
(37, 1, 'Cubal'),
(38, 1, 'Ganda'),
(39, 1, 'Lubito'),
(40, 2, 'Cabinda'),
(41, 2, 'Belize'),
(42, 2, 'Buco-Zau'),
(43, 2, 'Cacongo'),
(44, 12, 'Kuito'),
(45, 12, 'Andulo'),
(46, 12, 'Camacupa'),
(47, 12, 'Catabola'),
(48, 12, 'Chingular'),
(49, 12, 'Chitembo'),
(50, 12, 'Cuemba'),
(51, 12, 'Cunhinga'),
(52, 12, 'Nharea'),
(53, 17, 'Menongue'),
(54, 17, 'Calai'),
(55, 17, 'Cuangar'),
(56, 17, 'Cuchi'),
(57, 17, 'Cuito Cuanavale'),
(58, 17, 'Dirico'),
(59, 17, 'Mavinga'),
(60, 17, 'Nancova'),
(61, 17, 'Rivungo'),
(62, 10, 'N''dalatando'),
(63, 10, 'Ambaca'),
(64, 10, 'Banga'),
(65, 10, 'Bolongongo'),
(66, 10, 'Cambambe'),
(67, 10, 'Cazengo'),
(68, 10, 'Golungo Alto'),
(69, 10, 'Gonguembo'),
(70, 10, 'Lucala'),
(71, 10, 'Quiculungo'),
(72, 10, 'Samba Caju'),
(73, 11, 'Sumbe'),
(74, 11, 'Amboim'),
(75, 11, 'Cassongue'),
(76, 11, 'Cela'),
(77, 11, 'Conda'),
(78, 11, 'Ebo'),
(79, 11, 'Mussende'),
(80, 11, 'Porto Amboim'),
(81, 11, 'Quibala'),
(82, 11, 'Quilenda'),
(83, 11, 'Seles'),
(84, 18, 'Ondjiva'),
(85, 18, 'Cahama'),
(86, 18, 'Cuanhama'),
(87, 18, 'Curoca'),
(88, 18, 'Cuvale'),
(89, 18, 'Namacunde'),
(90, 18, 'Ombanja'),
(91, 3, 'Huambo'),
(92, 3, 'Bailundo'),
(93, 3, 'Catchiungo'),
(94, 3, 'CaÃ¡la'),
(95, 3, 'Ekunha'),
(96, 3, 'Londuimbale'),
(97, 3, 'Longonjo'),
(98, 3, 'Mungo Amboim'),
(99, 3, 'Tchicala-Tcholoanga'),
(100, 3, 'Tchindjenje'),
(101, 3, 'Ucuma'),
(102, 6, 'Luanda'),
(103, 6, 'Cacuaco'),
(104, 6, 'Cazenga'),
(105, 6, 'Ingombota'),
(106, 6, 'Kilamba Kiaxi'),
(107, 6, 'Mainga'),
(108, 6, 'Rangel'),
(109, 6, 'Samba'),
(110, 6, 'Sambizanga'),
(111, 6, 'Viana'),
(112, 9, 'Dundo'),
(113, 9, 'Cambulo'),
(114, 9, 'Capenda-Camulemba'),
(115, 9, 'Caungula'),
(116, 9, 'Chitato'),
(117, 9, 'Cuango'),
(118, 9, 'CuÃ­lo'),
(119, 9, 'Lubalo'),
(120, 9, 'XÃ¡-Muteba'),
(121, 8, 'Saurimo'),
(122, 8, 'Cacolo'),
(123, 8, 'Dala'),
(124, 8, 'Muconda'),
(125, 5, 'Malanje'),
(126, 5, 'Cacuso'),
(127, 5, 'Calandula'),
(128, 5, 'Cambundi-Catembo'),
(129, 5, 'Cangandala'),
(130, 5, 'Caombo'),
(131, 5, 'Cuaba Nzongo'),
(132, 5, 'Cunda-Dia-Baze'),
(133, 5, 'Luquembo'),
(134, 5, 'Marimba'),
(135, 5, 'Massango'),
(136, 5, 'Mucari'),
(137, 5, 'Quela'),
(138, 5, 'Quirima'),
(139, 16, 'Luena'),
(140, 16, 'Alto Zambeze'),
(141, 16, 'Bundas'),
(142, 16, 'Camanongue'),
(143, 16, 'LÃ©ua'),
(144, 16, 'Luau'),
(145, 16, 'Luacano'),
(146, 16, 'Luchazes'),
(147, 16, 'Moxico'),
(148, 14, 'UÃ­ge'),
(149, 14, 'Alto Cauale'),
(150, 14, 'AmbuÃ­la'),
(151, 14, 'Bembe'),
(152, 14, 'Buengas'),
(153, 14, 'Damba'),
(154, 14, 'Macocola'),
(155, 14, 'Mucaba'),
(156, 14, 'Negage'),
(157, 14, 'Puri'),
(158, 14, 'Quimbele'),
(159, 14, 'Quitexe'),
(160, 14, 'Sanza Pombo'),
(161, 14, 'Songo'),
(162, 14, 'Zombo'),
(163, 15, 'M''Banza Kongo'),
(164, 15, 'Cuimba'),
(165, 15, 'Noqui'),
(166, 15, 'N''Zeto'),
(167, 15, 'Soyo'),
(168, 15, 'Tomboco');

-- --------------------------------------------------------

--
-- Estrutura da tabela `tbl_notasfinais`
--

CREATE TABLE `tbl_notasfinais` (
  `id_notasfinais` bigint(20) NOT NULL,
  `id_estudante` int(11) NOT NULL,
  `id_disciplina` int(11) NOT NULL,
  `cap` decimal(4,2) DEFAULT NULL,
  `cpe` decimal(4,2) DEFAULT NULL,
  `cf` decimal(4,0) DEFAULT NULL,
  `estado` varchar(20) DEFAULT NULL,
  `data_lancamento` date DEFAULT NULL,
  `ano_lectivo` int(6) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estrutura da tabela `tbl_notastrimestrais`
--

CREATE TABLE `tbl_notastrimestrais` (
  `id_notastrimestrais` bigint(20) NOT NULL,
  `id_estudante` int(11) NOT NULL,
  `id_disciplina` int(11) NOT NULL,
  `epoca` int(6) NOT NULL,
  `mac` decimal(4,2) DEFAULT NULL,
  `cpp` decimal(4,2) DEFAULT NULL,
  `ct` decimal(4,2) DEFAULT NULL,
  `data_lancamento` date DEFAULT NULL,
  `ano_lectivo` int(6) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estrutura da tabela `tbl_permicaousuario`
--

CREATE TABLE `tbl_permicaousuario` (
  `id_permicaousuario` bigint(20) NOT NULL,
  `id_usuario` int(11) NOT NULL,
  `id_tipopermicao` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `tbl_permicaousuario`
--

INSERT INTO `tbl_permicaousuario` (`id_permicaousuario`, `id_usuario`, `id_tipopermicao`) VALUES
(1, 1, 1);

-- --------------------------------------------------------

--
-- Estrutura da tabela `tbl_pessoa`
--

CREATE TABLE `tbl_pessoa` (
  `id_pessoa` int(11) NOT NULL,
  `nome` varchar(80) NOT NULL,
  `data_nascimento` date NOT NULL,
  `genero` varchar(10) NOT NULL,
  `estado_civil` varchar(25) NOT NULL,
  `naturalidade` varchar(60) DEFAULT NULL,
  `id_provincia` int(11) DEFAULT NULL,
  `id_municipio` int(11) DEFAULT NULL,
  `telefone` int(17) DEFAULT NULL,
  `bilhete` varchar(20) DEFAULT NULL,
  `data_emissao` varchar(16) DEFAULT NULL,
  `local_emissao` varchar(50) DEFAULT NULL,
  `pai` varchar(80) DEFAULT NULL,
  `mae` varchar(80) DEFAULT NULL,
  `idade` int(11) DEFAULT NULL,
  `comuna` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `tbl_pessoa`
--

INSERT INTO `tbl_pessoa` (`id_pessoa`, `nome`, `data_nascimento`, `genero`, `estado_civil`, `naturalidade`, `id_provincia`, `id_municipio`, `telefone`, `bilhete`, `data_emissao`, `local_emissao`, `pai`, `mae`, `idade`, `comuna`) VALUES
(1, 'root', '1000-01-01', 'Masculino', 'solteiro', NULL, 7, 1, NULL, '', NULL, NULL, NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Estrutura da tabela `tbl_prova`
--

CREATE TABLE `tbl_prova` (
  `id_prova` bigint(20) NOT NULL,
  `id_estudante` int(11) NOT NULL,
  `id_disciplina` int(11) NOT NULL,
  `epoca` int(11) NOT NULL,
  `valor1` decimal(4,2) DEFAULT NULL,
  `data_valor1` date DEFAULT NULL,
  `valor2` decimal(4,2) DEFAULT NULL,
  `data_valor2` date DEFAULT NULL,
  `ano_lectivo` int(6) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estrutura da tabela `tbl_provincia`
--

CREATE TABLE `tbl_provincia` (
  `id_provincia` int(11) NOT NULL,
  `provincia` varchar(80) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `tbl_provincia`
--

INSERT INTO `tbl_provincia` (`id_provincia`, `provincia`) VALUES
(1, 'Benguela'),
(2, 'Cabinda'),
(3, 'Huambo'),
(4, 'Bengo'),
(5, 'Malanje'),
(6, 'Luanda'),
(7, 'Namibe'),
(8, 'Lunda Sul'),
(9, 'Lunda Norte'),
(10, 'Kwanza Norte'),
(11, 'Kwanza Sul'),
(12, 'Bie'),
(13, 'HuÃ­la'),
(14, 'UÃ­ge'),
(15, 'Zaire'),
(16, 'Moxico'),
(17, 'Cuando Cubango'),
(18, 'Cunene');

-- --------------------------------------------------------

--
-- Estrutura da tabela `tbl_sala`
--

CREATE TABLE `tbl_sala` (
  `id_sala` int(11) NOT NULL,
  `id_tiposala` int(11) NOT NULL,
  `quant_estudantes` int(7) NOT NULL,
  `designacao` varchar(40) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estrutura da tabela `tbl_senha`
--

CREATE TABLE `tbl_senha` (
  `id_senha` int(11) NOT NULL,
  `id_usuario` int(11) NOT NULL,
  `senha` varchar(80) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `tbl_senha`
--

INSERT INTO `tbl_senha` (`id_senha`, `id_usuario`, `senha`) VALUES
(1, 1, 'olamundo2015');

-- --------------------------------------------------------

--
-- Estrutura da tabela `tbl_tipopermicao`
--

CREATE TABLE `tbl_tipopermicao` (
  `id_tipopermicao` int(11) NOT NULL,
  `tipo` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `tbl_tipopermicao`
--

INSERT INTO `tbl_tipopermicao` (`id_tipopermicao`, `tipo`) VALUES
(1, 'all'),
(2, 'restrit 1'),
(3, 'restrit 2'),
(4, 'super-restrit');

-- --------------------------------------------------------

--
-- Estrutura da tabela `tbl_tiposala`
--

CREATE TABLE `tbl_tiposala` (
  `id_tiposala` int(11) NOT NULL,
  `tipo` varchar(40) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `tbl_tiposala`
--

INSERT INTO `tbl_tiposala` (`id_tiposala`, `tipo`) VALUES
(1, 'Normal'),
(3, 'Anexa'),
(4, 'RefeitÃ³rio'),
(5, 'LaboratÃ³rio'),
(6, 'SalÃ£o'),
(11, 'PrimÃ¡rio');

-- --------------------------------------------------------

--
-- Estrutura da tabela `tbl_tipo_desistencia`
--

CREATE TABLE `tbl_tipo_desistencia` (
  `id_tipo_desistencia` int(11) NOT NULL,
  `tipo` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `tbl_tipo_desistencia`
--

INSERT INTO `tbl_tipo_desistencia` (`id_tipo_desistencia`, `tipo`) VALUES
(1, 'Transferencia'),
(2, 'Desistencia');

-- --------------------------------------------------------

--
-- Estrutura da tabela `tbl_tipo_faltas`
--

CREATE TABLE `tbl_tipo_faltas` (
  `id_tipo_falta` bigint(20) NOT NULL,
  `descricao_falta` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `tbl_tipo_faltas`
--

INSERT INTO `tbl_tipo_faltas` (`id_tipo_falta`, `descricao_falta`) VALUES
(1, 'Normal'),
(2, 'Indisciplinar');

-- --------------------------------------------------------

--
-- Estrutura da tabela `tbl_turma`
--

CREATE TABLE `tbl_turma` (
  `id_turma` int(11) NOT NULL,
  `id_curso` int(11) NOT NULL,
  `id_classe` int(11) NOT NULL,
  `id_turno` int(11) NOT NULL,
  `turma` varchar(80) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `tbl_turma`
--

INSERT INTO `tbl_turma` (`id_turma`, `id_curso`, `id_classe`, `id_turno`, `turma`) VALUES
(1, 1, 1, 1, 'nenhum');

-- --------------------------------------------------------

--
-- Estrutura da tabela `tbl_turno`
--

CREATE TABLE `tbl_turno` (
  `id_turno` int(11) NOT NULL,
  `turno` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `tbl_turno`
--

INSERT INTO `tbl_turno` (`id_turno`, `turno`) VALUES
(1, 'nenhum'),
(2, 'ManhÃ£'),
(3, 'Tarde'),
(4, 'Noite');

-- --------------------------------------------------------

--
-- Estrutura da tabela `tbl_usuario`
--

CREATE TABLE `tbl_usuario` (
  `id_usuario` int(11) NOT NULL,
  `id_funcionario` int(11) NOT NULL,
  `nome_usuario` varchar(80) NOT NULL,
  `estado` varchar(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `tbl_usuario`
--

INSERT INTO `tbl_usuario` (`id_usuario`, `id_funcionario`, `nome_usuario`, `estado`) VALUES
(1, 1, 'root', 'on');

-- --------------------------------------------------------

--
-- Stand-in structure for view `view_avaliacao`
--
CREATE TABLE `view_avaliacao` (
`id_avaliacao` bigint(20)
,`id_estudante` int(11)
,`id_disciplina` int(11)
,`nome` varchar(80)
,`genero` varchar(10)
,`idade` int(11)
,`turma` varchar(80)
,`nome_disciplina` varchar(200)
,`sigla` varchar(15)
,`epoca` int(11)
,`valor1` decimal(4,2)
,`data_valor1` date
,`valor2` decimal(4,2)
,`data_valor2` date
,`valor3` decimal(4,2)
,`data_valor3` date
,`ano_lectivo` int(6)
);

-- --------------------------------------------------------

--
-- Stand-in structure for view `view_classe`
--
CREATE TABLE `view_classe` (
`id_classe` int(11)
,`id_curso` int(11)
,`classe` varchar(80)
,`nome_curso` varchar(80)
);

-- --------------------------------------------------------

--
-- Stand-in structure for view `view_curso`
--
CREATE TABLE `view_curso` (
`id_curso` int(11)
,`nome_curso` varchar(80)
,`ensino` varchar(100)
);

-- --------------------------------------------------------

--
-- Stand-in structure for view `view_director`
--
CREATE TABLE `view_director` (
`id_director` bigint(20)
,`id_funcionario` int(11)
,`nome` varchar(80)
,`data_nascimento` date
,`genero` varchar(10)
,`agente` varchar(20)
,`ensino` varchar(100)
,`nome_curso` varchar(80)
,`classe` varchar(80)
,`id_turma` int(11)
,`turma` varchar(80)
,`turno` varchar(20)
,`ano_lectivo` int(6)
);

-- --------------------------------------------------------

--
-- Stand-in structure for view `view_disccurso`
--
CREATE TABLE `view_disccurso` (
`id_disccurso` bigint(20)
,`id_disciplina` int(11)
,`nome_curso` varchar(80)
,`classe` varchar(80)
,`nome_disciplina` varchar(200)
,`sigla` varchar(15)
,`tipo` varchar(30)
);

-- --------------------------------------------------------

--
-- Stand-in structure for view `view_disciplina`
--
CREATE TABLE `view_disciplina` (
`id_disciplina` int(11)
,`nome_disciplina` varchar(200)
,`sigla` varchar(15)
,`componente` varchar(100)
);

-- --------------------------------------------------------

--
-- Stand-in structure for view `view_estudante`
--
CREATE TABLE `view_estudante` (
`id_estudante` int(11)
,`nome` varchar(80)
,`genero` varchar(10)
,`idade` int(11)
,`data_nascimento` date
,`ensino` varchar(100)
,`nome_curso` varchar(80)
,`classe` varchar(80)
,`turma` varchar(80)
,`data_cadastro` date
,`data_modificacao` date
,`estadoE` int(11)
,`ano_lectivo` int(6)
);

-- --------------------------------------------------------

--
-- Stand-in structure for view `view_funcionario`
--
CREATE TABLE `view_funcionario` (
`id_funcionario` int(11)
,`nome` varchar(80)
,`genero` varchar(10)
,`comuna` varchar(100)
,`cargo` varchar(80)
,`nome_escalao` varchar(100)
,`agente` varchar(20)
,`data_cadastro` date
,`data_modificacao` date
,`estadoF` int(11)
);

-- --------------------------------------------------------

--
-- Stand-in structure for view `view_horario`
--
CREATE TABLE `view_horario` (
`id_horario` int(11)
,`id_funcionario` int(11)
,`id_disciplina` int(11)
,`id_turma` int(11)
,`agente` varchar(20)
,`nome` varchar(80)
,`nome_disciplina` varchar(200)
,`sigla` varchar(15)
,`turma` varchar(80)
,`designacao` varchar(40)
,`ano_lectivo` int(6)
);

-- --------------------------------------------------------

--
-- Stand-in structure for view `view_notasfinais`
--
CREATE TABLE `view_notasfinais` (
`id_notasfinais` bigint(20)
,`id_estudante` int(11)
,`id_disciplina` int(11)
,`nome` varchar(80)
,`genero` varchar(10)
,`idade` int(11)
,`turma` varchar(80)
,`nome_disciplina` varchar(200)
,`sigla` varchar(15)
,`cap` decimal(4,2)
,`cpe` decimal(4,2)
,`cf` decimal(4,0)
,`estado` varchar(20)
,`data_lancamento` date
,`ano_lectivo` int(6)
);

-- --------------------------------------------------------

--
-- Stand-in structure for view `view_notastrimestrais`
--
CREATE TABLE `view_notastrimestrais` (
`id_notastrimestrais` bigint(20)
,`id_estudante` int(11)
,`id_disciplina` int(11)
,`nome` varchar(80)
,`genero` varchar(10)
,`idade` int(11)
,`turma` varchar(80)
,`nome_disciplina` varchar(200)
,`sigla` varchar(15)
,`epoca` int(6)
,`mac` decimal(4,2)
,`cpp` decimal(4,2)
,`ct` decimal(4,2)
,`data_lancamento` date
,`ano_lectivo` int(6)
);

-- --------------------------------------------------------

--
-- Stand-in structure for view `view_permicaousuario`
--
CREATE TABLE `view_permicaousuario` (
`id_permicaousuario` bigint(20)
,`id_usuario` int(11)
,`tipo` varchar(100)
);

-- --------------------------------------------------------

--
-- Stand-in structure for view `view_prova`
--
CREATE TABLE `view_prova` (
`id_prova` bigint(20)
,`id_estudante` int(11)
,`id_disciplina` int(11)
,`nome` varchar(80)
,`genero` varchar(10)
,`idade` int(11)
,`turma` varchar(80)
,`nome_disciplina` varchar(200)
,`sigla` varchar(15)
,`epoca` int(11)
,`valor1` decimal(4,2)
,`data_valor1` date
,`valor2` decimal(4,2)
,`data_valor2` date
,`ano_lectivo` int(6)
);

-- --------------------------------------------------------

--
-- Stand-in structure for view `view_salas`
--
CREATE TABLE `view_salas` (
`id_sala` int(11)
,`tipo` varchar(40)
,`quant_estudantes` int(7)
,`designacao` varchar(40)
);

-- --------------------------------------------------------

--
-- Stand-in structure for view `view_turma`
--
CREATE TABLE `view_turma` (
`id_turma` int(11)
,`turma` varchar(80)
,`ensino` varchar(100)
,`nome_curso` varchar(80)
,`classe` varchar(80)
,`turno` varchar(20)
);

-- --------------------------------------------------------

--
-- Stand-in structure for view `view_usuarios`
--
CREATE TABLE `view_usuarios` (
`id_usuario` int(11)
,`id_funcionario` int(11)
,`agente` varchar(20)
,`nome_usuario` varchar(80)
,`estado_us` varchar(5)
,`senha` varchar(80)
,`cargo` varchar(80)
,`nome` varchar(80)
,`genero` varchar(10)
,`idade` int(11)
,`telefone` int(17)
,`provincia` varchar(80)
,`municipio` varchar(90)
);

-- --------------------------------------------------------

--
-- Structure for view `view_avaliacao`
--
DROP TABLE IF EXISTS `view_avaliacao`;

CREATE VIEW `view_avaliacao`  AS  select `a`.`id_avaliacao` AS `id_avaliacao`,`e`.`id_estudante` AS `id_estudante`,`d`.`id_disciplina` AS `id_disciplina`,`p`.`nome` AS `nome`,`p`.`genero` AS `genero`,`p`.`idade` AS `idade`,`t`.`turma` AS `turma`,`d`.`nome_disciplina` AS `nome_disciplina`,`d`.`sigla` AS `sigla`,`a`.`epoca` AS `epoca`,`a`.`valor1` AS `valor1`,`a`.`data_valor1` AS `data_valor1`,`a`.`valor2` AS `valor2`,`a`.`data_valor2` AS `data_valor2`,`a`.`valor3` AS `valor3`,`a`.`data_valor3` AS `data_valor3`,`a`.`ano_lectivo` AS `ano_lectivo` from ((((`tbl_avaliacao` `a` join `tbl_estudante` `e` on((`a`.`id_estudante` = `e`.`id_estudante`))) join `tbl_disciplina` `d` on((`a`.`id_disciplina` = `d`.`id_disciplina`))) join `tbl_pessoa` `p` on((`e`.`id_pessoa` = `p`.`id_pessoa`))) join `tbl_turma` `t` on((`e`.`id_turma` = `t`.`id_turma`))) ;

-- --------------------------------------------------------

--
-- Structure for view `view_classe`
--
DROP TABLE IF EXISTS `view_classe`;

CREATE VIEW `view_classe`  AS  select `cl`.`id_classe` AS `id_classe`,`cl`.`id_curso` AS `id_curso`,`cl`.`classe` AS `classe`,`c`.`nome_curso` AS `nome_curso` from (`tbl_classe` `cl` join `tbl_curso` `c` on((`cl`.`id_curso` = `c`.`id_curso`))) ;

-- --------------------------------------------------------

--
-- Structure for view `view_curso`
--
DROP TABLE IF EXISTS `view_curso`;

CREATE VIEW `view_curso`  AS  select `c`.`id_curso` AS `id_curso`,`c`.`nome_curso` AS `nome_curso`,`e`.`ensino` AS `ensino` from (`tbl_curso` `c` join `tbl_ensino` `e` on((`c`.`id_ensino` = `e`.`id_ensino`))) ;

-- --------------------------------------------------------

--
-- Structure for view `view_director`
--
DROP TABLE IF EXISTS `view_director`;

CREATE VIEW `view_director`  AS  select `dir`.`id_director` AS `id_director`,`f`.`id_funcionario` AS `id_funcionario`,`p`.`nome` AS `nome`,`p`.`data_nascimento` AS `data_nascimento`,`p`.`genero` AS `genero`,`f`.`agente` AS `agente`,`ens`.`ensino` AS `ensino`,`cur`.`nome_curso` AS `nome_curso`,`cl`.`classe` AS `classe`,`t`.`id_turma` AS `id_turma`,`t`.`turma` AS `turma`,`tur`.`turno` AS `turno`,`dir`.`ano_lectivo` AS `ano_lectivo` from (((((((`tbl_director` `dir` join `tbl_funcionario` `f` on((`dir`.`id_funcionario` = `f`.`id_funcionario`))) join `tbl_pessoa` `p` on((`p`.`id_pessoa` = `f`.`id_pessoa`))) join `tbl_turma` `t` on((`dir`.`id_turma` = `t`.`id_turma`))) join `tbl_curso` `cur` on((`t`.`id_curso` = `cur`.`id_curso`))) join `tbl_classe` `cl` on((`t`.`id_classe` = `cl`.`id_classe`))) join `tbl_ensino` `ens` on((`cur`.`id_ensino` = `ens`.`id_ensino`))) join `tbl_turno` `tur` on((`t`.`id_turno` = `tur`.`id_turno`))) ;

-- --------------------------------------------------------

--
-- Structure for view `view_disccurso`
--
DROP TABLE IF EXISTS `view_disccurso`;

CREATE VIEW `view_disccurso`  AS  select `disc`.`id_disccurso` AS `id_disccurso`,`disc`.`id_disciplina` AS `id_disciplina`,`c`.`nome_curso` AS `nome_curso`,`cl`.`classe` AS `classe`,`d`.`nome_disciplina` AS `nome_disciplina`,`d`.`sigla` AS `sigla`,`epd`.`tipo` AS `tipo` from ((((`tbl_disccurso` `disc` join `tbl_curso` `c` on((`disc`.`id_curso` = `c`.`id_curso`))) join `tbl_disciplina` `d` on((`disc`.`id_disciplina` = `d`.`id_disciplina`))) join `tbl_classe` `cl` on((`disc`.`id_classe` = `cl`.`id_classe`))) join `tbl_epocadis` `epd` on((`disc`.`id_epocaDis` = `epd`.`id_epocaDis`))) ;

-- --------------------------------------------------------

--
-- Structure for view `view_disciplina`
--
DROP TABLE IF EXISTS `view_disciplina`;

CREATE VIEW `view_disciplina`  AS  select `d`.`id_disciplina` AS `id_disciplina`,`d`.`nome_disciplina` AS `nome_disciplina`,`d`.`sigla` AS `sigla`,`c`.`componente` AS `componente` from (`tbl_disciplina` `d` join `tbl_componente` `c` on((`d`.`id_componente` = `c`.`id_componente`))) ;

-- --------------------------------------------------------

--
-- Structure for view `view_estudante`
--
DROP TABLE IF EXISTS `view_estudante`;

CREATE VIEW `view_estudante`  AS  select `e`.`id_estudante` AS `id_estudante`,`p`.`nome` AS `nome`,`p`.`genero` AS `genero`,`p`.`idade` AS `idade`,`p`.`data_nascimento` AS `data_nascimento`,`ens`.`ensino` AS `ensino`,`c`.`nome_curso` AS `nome_curso`,`cl`.`classe` AS `classe`,`t`.`turma` AS `turma`,`e`.`data_cadastro` AS `data_cadastro`,`e`.`data_modificacao` AS `data_modificacao`,`e`.`estadoE` AS `estadoE`,`e`.`ano_lectivo` AS `ano_lectivo` from (((((`tbl_estudante` `e` join `tbl_pessoa` `p` on((`e`.`id_pessoa` = `p`.`id_pessoa`))) join `tbl_curso` `c` on((`e`.`id_curso` = `c`.`id_curso`))) join `tbl_classe` `cl` on((`e`.`id_classe` = `cl`.`id_classe`))) join `tbl_turma` `t` on((`e`.`id_turma` = `t`.`id_turma`))) join `tbl_ensino` `ens` on((`c`.`id_ensino` = `ens`.`id_ensino`))) ;

-- --------------------------------------------------------

--
-- Structure for view `view_funcionario`
--
DROP TABLE IF EXISTS `view_funcionario`;

CREATE VIEW `view_funcionario`  AS  select `f`.`id_funcionario` AS `id_funcionario`,`p`.`nome` AS `nome`,`p`.`genero` AS `genero`,`p`.`comuna` AS `comuna`,`c`.`cargo` AS `cargo`,`e`.`nome_escalao` AS `nome_escalao`,`f`.`agente` AS `agente`,`f`.`data_cadastro` AS `data_cadastro`,`f`.`data_modificacao` AS `data_modificacao`,`f`.`estadoF` AS `estadoF` from (((`tbl_funcionario` `f` join `tbl_pessoa` `p` on((`f`.`id_pessoa` = `p`.`id_pessoa`))) join `tbl_escalao` `e` on((`f`.`id_escalao` = `e`.`id_escalao`))) join `tbl_cargo` `c` on((`f`.`id_cargo` = `c`.`id_cargo`))) ;

-- --------------------------------------------------------

--
-- Structure for view `view_horario`
--
DROP TABLE IF EXISTS `view_horario`;

CREATE VIEW `view_horario`  AS  select `h`.`id_horario` AS `id_horario`,`f`.`id_funcionario` AS `id_funcionario`,`d`.`id_disciplina` AS `id_disciplina`,`t`.`id_turma` AS `id_turma`,`f`.`agente` AS `agente`,`p`.`nome` AS `nome`,`d`.`nome_disciplina` AS `nome_disciplina`,`d`.`sigla` AS `sigla`,`t`.`turma` AS `turma`,`sl`.`designacao` AS `designacao`,`h`.`ano_lectivo` AS `ano_lectivo` from (((((`tbl_horario` `h` join `tbl_disciplina` `d` on((`h`.`id_disciplina` = `d`.`id_disciplina`))) join `tbl_turma` `t` on((`h`.`id_turma` = `t`.`id_turma`))) join `tbl_sala` `sl` on((`h`.`id_sala` = `sl`.`id_sala`))) join `tbl_funcionario` `f` on((`h`.`id_funcionario` = `f`.`id_funcionario`))) join `tbl_pessoa` `p` on((`f`.`id_pessoa` = `p`.`id_pessoa`))) ;

-- --------------------------------------------------------

--
-- Structure for view `view_notasfinais`
--
DROP TABLE IF EXISTS `view_notasfinais`;

CREATE VIEW `view_notasfinais`  AS  select `nt`.`id_notasfinais` AS `id_notasfinais`,`e`.`id_estudante` AS `id_estudante`,`d`.`id_disciplina` AS `id_disciplina`,`p`.`nome` AS `nome`,`p`.`genero` AS `genero`,`p`.`idade` AS `idade`,`t`.`turma` AS `turma`,`d`.`nome_disciplina` AS `nome_disciplina`,`d`.`sigla` AS `sigla`,`nt`.`cap` AS `cap`,`nt`.`cpe` AS `cpe`,`nt`.`cf` AS `cf`,`nt`.`estado` AS `estado`,`nt`.`data_lancamento` AS `data_lancamento`,`nt`.`ano_lectivo` AS `ano_lectivo` from ((((`tbl_notasfinais` `nt` join `tbl_estudante` `e` on((`nt`.`id_estudante` = `e`.`id_estudante`))) join `tbl_turma` `t` on((`e`.`id_turma` = `t`.`id_turma`))) join `tbl_pessoa` `p` on((`p`.`id_pessoa` = `e`.`id_pessoa`))) join `tbl_disciplina` `d` on((`nt`.`id_disciplina` = `d`.`id_disciplina`))) ;

-- --------------------------------------------------------

--
-- Structure for view `view_notastrimestrais`
--
DROP TABLE IF EXISTS `view_notastrimestrais`;

CREATE VIEW `view_notastrimestrais`  AS  select `nt`.`id_notastrimestrais` AS `id_notastrimestrais`,`e`.`id_estudante` AS `id_estudante`,`d`.`id_disciplina` AS `id_disciplina`,`p`.`nome` AS `nome`,`p`.`genero` AS `genero`,`p`.`idade` AS `idade`,`t`.`turma` AS `turma`,`d`.`nome_disciplina` AS `nome_disciplina`,`d`.`sigla` AS `sigla`,`nt`.`epoca` AS `epoca`,`nt`.`mac` AS `mac`,`nt`.`cpp` AS `cpp`,`nt`.`ct` AS `ct`,`nt`.`data_lancamento` AS `data_lancamento`,`nt`.`ano_lectivo` AS `ano_lectivo` from ((((`tbl_notastrimestrais` `nt` join `tbl_estudante` `e` on((`nt`.`id_estudante` = `e`.`id_estudante`))) join `tbl_turma` `t` on((`e`.`id_turma` = `t`.`id_turma`))) join `tbl_pessoa` `p` on((`p`.`id_pessoa` = `e`.`id_pessoa`))) join `tbl_disciplina` `d` on((`nt`.`id_disciplina` = `d`.`id_disciplina`))) ;

-- --------------------------------------------------------

--
-- Structure for view `view_permicaousuario`
--
DROP TABLE IF EXISTS `view_permicaousuario`;

CREATE VIEW `view_permicaousuario`  AS  select `peru`.`id_permicaousuario` AS `id_permicaousuario`,`peru`.`id_usuario` AS `id_usuario`,`tperu`.`tipo` AS `tipo` from (`tbl_permicaousuario` `peru` join `tbl_tipopermicao` `tperu` on((`peru`.`id_tipopermicao` = `tperu`.`id_tipopermicao`))) ;

-- --------------------------------------------------------

--
-- Structure for view `view_prova`
--
DROP TABLE IF EXISTS `view_prova`;

CREATE VIEW `view_prova`  AS  select `pr`.`id_prova` AS `id_prova`,`e`.`id_estudante` AS `id_estudante`,`d`.`id_disciplina` AS `id_disciplina`,`p`.`nome` AS `nome`,`p`.`genero` AS `genero`,`p`.`idade` AS `idade`,`t`.`turma` AS `turma`,`d`.`nome_disciplina` AS `nome_disciplina`,`d`.`sigla` AS `sigla`,`pr`.`epoca` AS `epoca`,`pr`.`valor1` AS `valor1`,`pr`.`data_valor1` AS `data_valor1`,`pr`.`valor2` AS `valor2`,`pr`.`data_valor2` AS `data_valor2`,`pr`.`ano_lectivo` AS `ano_lectivo` from ((((`tbl_prova` `pr` join `tbl_estudante` `e` on((`pr`.`id_estudante` = `e`.`id_estudante`))) join `tbl_disciplina` `d` on((`pr`.`id_disciplina` = `d`.`id_disciplina`))) join `tbl_pessoa` `p` on((`e`.`id_pessoa` = `p`.`id_pessoa`))) join `tbl_turma` `t` on((`e`.`id_turma` = `t`.`id_turma`))) ;

-- --------------------------------------------------------

--
-- Structure for view `view_salas`
--
DROP TABLE IF EXISTS `view_salas`;

CREATE VIEW `view_salas`  AS  select `s`.`id_sala` AS `id_sala`,`t`.`tipo` AS `tipo`,`s`.`quant_estudantes` AS `quant_estudantes`,`s`.`designacao` AS `designacao` from (`tbl_sala` `s` join `tbl_tiposala` `t` on((`s`.`id_tiposala` = `t`.`id_tiposala`))) ;

-- --------------------------------------------------------

--
-- Structure for view `view_turma`
--
DROP TABLE IF EXISTS `view_turma`;

CREATE VIEW `view_turma`  AS  select `t`.`id_turma` AS `id_turma`,`t`.`turma` AS `turma`,`e`.`ensino` AS `ensino`,`c`.`nome_curso` AS `nome_curso`,`cl`.`classe` AS `classe`,`tu`.`turno` AS `turno` from ((((`tbl_turma` `t` join `tbl_curso` `c` on((`t`.`id_curso` = `c`.`id_curso`))) join `tbl_classe` `cl` on((`t`.`id_classe` = `cl`.`id_classe`))) join `tbl_turno` `tu` on((`t`.`id_turno` = `tu`.`id_turno`))) join `tbl_ensino` `e` on((`e`.`id_ensino` = `c`.`id_ensino`))) ;

-- --------------------------------------------------------

--
-- Structure for view `view_usuarios`
--
DROP TABLE IF EXISTS `view_usuarios`;

CREATE  VIEW `view_usuarios`  AS  select `u`.`id_usuario` AS `id_usuario`,`f`.`id_funcionario` AS `id_funcionario`,`f`.`agente` AS `agente`,`u`.`nome_usuario` AS `nome_usuario`,`u`.`estado` AS `estado_us`,`s`.`senha` AS `senha`,`c`.`cargo` AS `cargo`,`p`.`nome` AS `nome`,`p`.`genero` AS `genero`,`p`.`idade` AS `idade`,`p`.`telefone` AS `telefone`,`pro`.`provincia` AS `provincia`,`m`.`municipio` AS `municipio` from ((((((`tbl_pessoa` `p` join `tbl_funcionario` `f` on((`p`.`id_pessoa` = `f`.`id_pessoa`))) join `tbl_usuario` `u` on((`f`.`id_funcionario` = `u`.`id_funcionario`))) join `tbl_cargo` `c` on((`f`.`id_cargo` = `c`.`id_cargo`))) join `tbl_senha` `s` on((`u`.`id_usuario` = `s`.`id_usuario`))) join `tbl_provincia` `pro` on((`p`.`id_provincia` = `pro`.`id_provincia`))) join `tbl_municipio` `m` on((`p`.`id_municipio` = `m`.`id_municipio`))) ;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tbl_avaliacao`
--
ALTER TABLE `tbl_avaliacao`
  ADD PRIMARY KEY (`id_avaliacao`),
  ADD KEY `fk_id_estudante5` (`id_estudante`),
  ADD KEY `fk_id_disciplina5` (`id_disciplina`);

--
-- Indexes for table `tbl_bloqueios`
--
ALTER TABLE `tbl_bloqueios`
  ADD PRIMARY KEY (`epoca`);

--
-- Indexes for table `tbl_cargo`
--
ALTER TABLE `tbl_cargo`
  ADD PRIMARY KEY (`id_cargo`);

--
-- Indexes for table `tbl_classe`
--
ALTER TABLE `tbl_classe`
  ADD PRIMARY KEY (`id_classe`),
  ADD KEY `fk_id_curso` (`id_curso`);

--
-- Indexes for table `tbl_componente`
--
ALTER TABLE `tbl_componente`
  ADD PRIMARY KEY (`id_componente`);

--
-- Indexes for table `tbl_curso`
--
ALTER TABLE `tbl_curso`
  ADD PRIMARY KEY (`id_curso`),
  ADD KEY `fk_id_ensino` (`id_ensino`);

--
-- Indexes for table `tbl_desistencias`
--
ALTER TABLE `tbl_desistencias`
  ADD PRIMARY KEY (`id_desistencia`),
  ADD KEY `id_pessoa` (`id_pessoa`),
  ADD KEY `id_tipo_desistencia` (`id_tipo_desistencia`);

--
-- Indexes for table `tbl_director`
--
ALTER TABLE `tbl_director`
  ADD PRIMARY KEY (`id_director`),
  ADD KEY `fk_id_funcionario` (`id_funcionario`),
  ADD KEY `fk_id_turma` (`id_turma`);

--
-- Indexes for table `tbl_disccurso`
--
ALTER TABLE `tbl_disccurso`
  ADD PRIMARY KEY (`id_disccurso`),
  ADD KEY `fk_id_curso1` (`id_curso`),
  ADD KEY `fk_id_disciplina1` (`id_disciplina`),
  ADD KEY `fk_id_classe` (`id_classe`),
  ADD KEY `fk_id_epocaDis` (`id_epocaDis`);

--
-- Indexes for table `tbl_disciplina`
--
ALTER TABLE `tbl_disciplina`
  ADD PRIMARY KEY (`id_disciplina`),
  ADD KEY `fk_id_componente` (`id_componente`);

--
-- Indexes for table `tbl_ensino`
--
ALTER TABLE `tbl_ensino`
  ADD PRIMARY KEY (`id_ensino`);

--
-- Indexes for table `tbl_epocadis`
--
ALTER TABLE `tbl_epocadis`
  ADD PRIMARY KEY (`id_epocaDis`);

--
-- Indexes for table `tbl_escalao`
--
ALTER TABLE `tbl_escalao`
  ADD PRIMARY KEY (`id_escalao`);

--
-- Indexes for table `tbl_estudante`
--
ALTER TABLE `tbl_estudante`
  ADD PRIMARY KEY (`id_estudante`),
  ADD KEY `fk_id_pessoa` (`id_pessoa`),
  ADD KEY `fk_id_turma1` (`id_turma`),
  ADD KEY `fk_id_curso10` (`id_curso`),
  ADD KEY `fk_id_classe10` (`id_classe`);

--
-- Indexes for table `tbl_faltasal`
--
ALTER TABLE `tbl_faltasal`
  ADD PRIMARY KEY (`id_faltaAl`),
  ADD KEY `id_estudante` (`id_estudante`),
  ADD KEY `id_disciplina` (`id_disciplina`),
  ADD KEY `id_tipo_falta` (`id_tipo_falta`);

--
-- Indexes for table `tbl_faltaspr`
--
ALTER TABLE `tbl_faltaspr`
  ADD PRIMARY KEY (`id_faltaPr`),
  ADD KEY `id_funcionario` (`id_funcionario`),
  ADD KEY `id_tipo_falta` (`id_tipo_falta`);

--
-- Indexes for table `tbl_funcionario`
--
ALTER TABLE `tbl_funcionario`
  ADD PRIMARY KEY (`id_funcionario`),
  ADD KEY `fk_id_pessoa1` (`id_pessoa`),
  ADD KEY `fk_id_cargo` (`id_cargo`),
  ADD KEY `fk_id_escalao` (`id_escalao`);

--
-- Indexes for table `tbl_historico`
--
ALTER TABLE `tbl_historico`
  ADD PRIMARY KEY (`id_historico`),
  ADD KEY `fk_id_estudante2` (`id_estudante`),
  ADD KEY `fk_id_turma2` (`id_turma`);

--
-- Indexes for table `tbl_horario`
--
ALTER TABLE `tbl_horario`
  ADD PRIMARY KEY (`id_horario`),
  ADD KEY `fk_id_hora` (`id_hora`),
  ADD KEY `fk_id_semana` (`id_semana`),
  ADD KEY `fk_id_disciplina2` (`id_disciplina`),
  ADD KEY `fk_id_turma3` (`id_turma`),
  ADD KEY `fk_id_sala` (`id_sala`),
  ADD KEY `fk_id_funcionario1` (`id_funcionario`);

--
-- Indexes for table `tbl_municipio`
--
ALTER TABLE `tbl_municipio`
  ADD PRIMARY KEY (`id_municipio`),
  ADD KEY `fk_id_provincia` (`id_provincia`);

--
-- Indexes for table `tbl_notasfinais`
--
ALTER TABLE `tbl_notasfinais`
  ADD PRIMARY KEY (`id_notasfinais`),
  ADD KEY `fk_id_estudante3` (`id_estudante`),
  ADD KEY `fk_id_disciplina3` (`id_disciplina`);

--
-- Indexes for table `tbl_notastrimestrais`
--
ALTER TABLE `tbl_notastrimestrais`
  ADD PRIMARY KEY (`id_notastrimestrais`),
  ADD KEY `fk_id_estudante4` (`id_estudante`),
  ADD KEY `fk_id_disciplina4` (`id_disciplina`);

--
-- Indexes for table `tbl_permicaousuario`
--
ALTER TABLE `tbl_permicaousuario`
  ADD PRIMARY KEY (`id_permicaousuario`),
  ADD KEY `fk_id_usuario` (`id_usuario`),
  ADD KEY `fk_id_tipopermicao` (`id_tipopermicao`);

--
-- Indexes for table `tbl_pessoa`
--
ALTER TABLE `tbl_pessoa`
  ADD PRIMARY KEY (`id_pessoa`),
  ADD KEY `fk_id_provincia1` (`id_provincia`),
  ADD KEY `fk_id_municipio` (`id_municipio`);

--
-- Indexes for table `tbl_prova`
--
ALTER TABLE `tbl_prova`
  ADD PRIMARY KEY (`id_prova`),
  ADD KEY `fk_id_disciplina6` (`id_disciplina`),
  ADD KEY `fk_id_estudante6` (`id_estudante`);

--
-- Indexes for table `tbl_provincia`
--
ALTER TABLE `tbl_provincia`
  ADD PRIMARY KEY (`id_provincia`);

--
-- Indexes for table `tbl_sala`
--
ALTER TABLE `tbl_sala`
  ADD PRIMARY KEY (`id_sala`),
  ADD KEY `fk_id_tiposala` (`id_tiposala`);

--
-- Indexes for table `tbl_senha`
--
ALTER TABLE `tbl_senha`
  ADD PRIMARY KEY (`id_senha`),
  ADD KEY `fk_id_usuario1` (`id_usuario`);

--
-- Indexes for table `tbl_tipopermicao`
--
ALTER TABLE `tbl_tipopermicao`
  ADD PRIMARY KEY (`id_tipopermicao`);

--
-- Indexes for table `tbl_tiposala`
--
ALTER TABLE `tbl_tiposala`
  ADD PRIMARY KEY (`id_tiposala`);

--
-- Indexes for table `tbl_tipo_desistencia`
--
ALTER TABLE `tbl_tipo_desistencia`
  ADD PRIMARY KEY (`id_tipo_desistencia`);

--
-- Indexes for table `tbl_tipo_faltas`
--
ALTER TABLE `tbl_tipo_faltas`
  ADD PRIMARY KEY (`id_tipo_falta`);

--
-- Indexes for table `tbl_turma`
--
ALTER TABLE `tbl_turma`
  ADD PRIMARY KEY (`id_turma`),
  ADD KEY `fk_id_curso2` (`id_curso`),
  ADD KEY `fk_id_classe1` (`id_classe`),
  ADD KEY `fk_id_turno1` (`id_turno`);

--
-- Indexes for table `tbl_turno`
--
ALTER TABLE `tbl_turno`
  ADD PRIMARY KEY (`id_turno`);

--
-- Indexes for table `tbl_usuario`
--
ALTER TABLE `tbl_usuario`
  ADD PRIMARY KEY (`id_usuario`),
  ADD KEY `fk_id_funcionario2` (`id_funcionario`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tbl_avaliacao`
--
ALTER TABLE `tbl_avaliacao`
  MODIFY `id_avaliacao` bigint(20) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `tbl_cargo`
--
ALTER TABLE `tbl_cargo`
  MODIFY `id_cargo` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT for table `tbl_classe`
--
ALTER TABLE `tbl_classe`
  MODIFY `id_classe` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `tbl_componente`
--
ALTER TABLE `tbl_componente`
  MODIFY `id_componente` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `tbl_curso`
--
ALTER TABLE `tbl_curso`
  MODIFY `id_curso` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `tbl_desistencias`
--
ALTER TABLE `tbl_desistencias`
  MODIFY `id_desistencia` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `tbl_director`
--
ALTER TABLE `tbl_director`
  MODIFY `id_director` bigint(20) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `tbl_disccurso`
--
ALTER TABLE `tbl_disccurso`
  MODIFY `id_disccurso` bigint(20) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `tbl_disciplina`
--
ALTER TABLE `tbl_disciplina`
  MODIFY `id_disciplina` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `tbl_ensino`
--
ALTER TABLE `tbl_ensino`
  MODIFY `id_ensino` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `tbl_epocadis`
--
ALTER TABLE `tbl_epocadis`
  MODIFY `id_epocaDis` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `tbl_escalao`
--
ALTER TABLE `tbl_escalao`
  MODIFY `id_escalao` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;
--
-- AUTO_INCREMENT for table `tbl_estudante`
--
ALTER TABLE `tbl_estudante`
  MODIFY `id_estudante` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `tbl_faltasal`
--
ALTER TABLE `tbl_faltasal`
  MODIFY `id_faltaAl` bigint(20) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `tbl_faltaspr`
--
ALTER TABLE `tbl_faltaspr`
  MODIFY `id_faltaPr` bigint(20) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `tbl_funcionario`
--
ALTER TABLE `tbl_funcionario`
  MODIFY `id_funcionario` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `tbl_historico`
--
ALTER TABLE `tbl_historico`
  MODIFY `id_historico` bigint(20) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `tbl_horario`
--
ALTER TABLE `tbl_horario`
  MODIFY `id_horario` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `tbl_municipio`
--
ALTER TABLE `tbl_municipio`
  MODIFY `id_municipio` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=169;
--
-- AUTO_INCREMENT for table `tbl_notasfinais`
--
ALTER TABLE `tbl_notasfinais`
  MODIFY `id_notasfinais` bigint(20) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `tbl_notastrimestrais`
--
ALTER TABLE `tbl_notastrimestrais`
  MODIFY `id_notastrimestrais` bigint(20) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `tbl_permicaousuario`
--
ALTER TABLE `tbl_permicaousuario`
  MODIFY `id_permicaousuario` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `tbl_pessoa`
--
ALTER TABLE `tbl_pessoa`
  MODIFY `id_pessoa` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `tbl_prova`
--
ALTER TABLE `tbl_prova`
  MODIFY `id_prova` bigint(20) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `tbl_provincia`
--
ALTER TABLE `tbl_provincia`
  MODIFY `id_provincia` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;
--
-- AUTO_INCREMENT for table `tbl_sala`
--
ALTER TABLE `tbl_sala`
  MODIFY `id_sala` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `tbl_senha`
--
ALTER TABLE `tbl_senha`
  MODIFY `id_senha` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `tbl_tipopermicao`
--
ALTER TABLE `tbl_tipopermicao`
  MODIFY `id_tipopermicao` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `tbl_tiposala`
--
ALTER TABLE `tbl_tiposala`
  MODIFY `id_tiposala` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;
--
-- AUTO_INCREMENT for table `tbl_tipo_desistencia`
--
ALTER TABLE `tbl_tipo_desistencia`
  MODIFY `id_tipo_desistencia` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `tbl_tipo_faltas`
--
ALTER TABLE `tbl_tipo_faltas`
  MODIFY `id_tipo_falta` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `tbl_turma`
--
ALTER TABLE `tbl_turma`
  MODIFY `id_turma` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `tbl_turno`
--
ALTER TABLE `tbl_turno`
  MODIFY `id_turno` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `tbl_usuario`
--
ALTER TABLE `tbl_usuario`
  MODIFY `id_usuario` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- Constraints for dumped tables
--

--
-- Limitadores para a tabela `tbl_avaliacao`
--
ALTER TABLE `tbl_avaliacao`
  ADD CONSTRAINT `fk_id_disciplina5` FOREIGN KEY (`id_disciplina`) REFERENCES `tbl_disciplina` (`id_disciplina`),
  ADD CONSTRAINT `fk_id_estudante5` FOREIGN KEY (`id_estudante`) REFERENCES `tbl_estudante` (`id_estudante`);

--
-- Limitadores para a tabela `tbl_classe`
--
ALTER TABLE `tbl_classe`
  ADD CONSTRAINT `fk_id_curso` FOREIGN KEY (`id_curso`) REFERENCES `tbl_curso` (`id_curso`);

--
-- Limitadores para a tabela `tbl_curso`
--
ALTER TABLE `tbl_curso`
  ADD CONSTRAINT `fk_id_ensino` FOREIGN KEY (`id_ensino`) REFERENCES `tbl_ensino` (`id_ensino`);

--
-- Limitadores para a tabela `tbl_desistencias`
--
ALTER TABLE `tbl_desistencias`
  ADD CONSTRAINT `tbl_desistencias_ibfk_1` FOREIGN KEY (`id_pessoa`) REFERENCES `tbl_pessoa` (`id_pessoa`),
  ADD CONSTRAINT `tbl_desistencias_ibfk_2` FOREIGN KEY (`id_tipo_desistencia`) REFERENCES `tbl_tipo_desistencia` (`id_tipo_desistencia`);

--
-- Limitadores para a tabela `tbl_director`
--
ALTER TABLE `tbl_director`
  ADD CONSTRAINT `fk_id_funcionario` FOREIGN KEY (`id_funcionario`) REFERENCES `tbl_funcionario` (`id_funcionario`),
  ADD CONSTRAINT `fk_id_turma` FOREIGN KEY (`id_turma`) REFERENCES `tbl_turma` (`id_turma`);

--
-- Limitadores para a tabela `tbl_disccurso`
--
ALTER TABLE `tbl_disccurso`
  ADD CONSTRAINT `fk_id_classe` FOREIGN KEY (`id_classe`) REFERENCES `tbl_classe` (`id_classe`),
  ADD CONSTRAINT `fk_id_curso1` FOREIGN KEY (`id_curso`) REFERENCES `tbl_curso` (`id_curso`),
  ADD CONSTRAINT `fk_id_disciplina1` FOREIGN KEY (`id_disciplina`) REFERENCES `tbl_disciplina` (`id_disciplina`),
  ADD CONSTRAINT `fk_id_epocaDis` FOREIGN KEY (`id_epocaDis`) REFERENCES `tbl_epocadis` (`id_epocaDis`);

--
-- Limitadores para a tabela `tbl_disciplina`
--
ALTER TABLE `tbl_disciplina`
  ADD CONSTRAINT `fk_id_componente` FOREIGN KEY (`id_componente`) REFERENCES `tbl_componente` (`id_componente`);

--
-- Limitadores para a tabela `tbl_estudante`
--
ALTER TABLE `tbl_estudante`
  ADD CONSTRAINT `fk_id_classe10` FOREIGN KEY (`id_classe`) REFERENCES `tbl_classe` (`id_classe`),
  ADD CONSTRAINT `fk_id_curso10` FOREIGN KEY (`id_curso`) REFERENCES `tbl_curso` (`id_curso`),
  ADD CONSTRAINT `fk_id_pessoa` FOREIGN KEY (`id_pessoa`) REFERENCES `tbl_pessoa` (`id_pessoa`),
  ADD CONSTRAINT `fk_id_turma1` FOREIGN KEY (`id_turma`) REFERENCES `tbl_turma` (`id_turma`);

--
-- Limitadores para a tabela `tbl_faltasal`
--
ALTER TABLE `tbl_faltasal`
  ADD CONSTRAINT `tbl_faltasal_ibfk_1` FOREIGN KEY (`id_estudante`) REFERENCES `tbl_estudante` (`id_estudante`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `tbl_faltasal_ibfk_2` FOREIGN KEY (`id_disciplina`) REFERENCES `tbl_disciplina` (`id_disciplina`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `tbl_faltasal_ibfk_3` FOREIGN KEY (`id_tipo_falta`) REFERENCES `tbl_tipo_faltas` (`id_tipo_falta`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Limitadores para a tabela `tbl_faltaspr`
--
ALTER TABLE `tbl_faltaspr`
  ADD CONSTRAINT `tbl_faltaspr_ibfk_1` FOREIGN KEY (`id_funcionario`) REFERENCES `tbl_funcionario` (`id_funcionario`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `tbl_faltaspr_ibfk_2` FOREIGN KEY (`id_tipo_falta`) REFERENCES `tbl_tipo_faltas` (`id_tipo_falta`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Limitadores para a tabela `tbl_funcionario`
--
ALTER TABLE `tbl_funcionario`
  ADD CONSTRAINT `fk_id_cargo` FOREIGN KEY (`id_cargo`) REFERENCES `tbl_cargo` (`id_cargo`),
  ADD CONSTRAINT `fk_id_escalao` FOREIGN KEY (`id_escalao`) REFERENCES `tbl_escalao` (`id_escalao`),
  ADD CONSTRAINT `fk_id_pessoa1` FOREIGN KEY (`id_pessoa`) REFERENCES `tbl_pessoa` (`id_pessoa`);

--
-- Limitadores para a tabela `tbl_historico`
--
ALTER TABLE `tbl_historico`
  ADD CONSTRAINT `fk_id_estudante2` FOREIGN KEY (`id_estudante`) REFERENCES `tbl_estudante` (`id_estudante`),
  ADD CONSTRAINT `fk_id_turma2` FOREIGN KEY (`id_turma`) REFERENCES `tbl_turma` (`id_turma`);

--
-- Limitadores para a tabela `tbl_horario`
--
ALTER TABLE `tbl_horario`
  ADD CONSTRAINT `fk_id_disciplina2` FOREIGN KEY (`id_disciplina`) REFERENCES `tbl_disciplina` (`id_disciplina`),
  ADD CONSTRAINT `fk_id_funcionario1` FOREIGN KEY (`id_funcionario`) REFERENCES `tbl_funcionario` (`id_funcionario`),
  ADD CONSTRAINT `fk_id_sala` FOREIGN KEY (`id_sala`) REFERENCES `tbl_sala` (`id_sala`),
  ADD CONSTRAINT `fk_id_turma3` FOREIGN KEY (`id_turma`) REFERENCES `tbl_turma` (`id_turma`);

--
-- Limitadores para a tabela `tbl_municipio`
--
ALTER TABLE `tbl_municipio`
  ADD CONSTRAINT `fk_id_provincia` FOREIGN KEY (`id_provincia`) REFERENCES `tbl_provincia` (`id_provincia`);

--
-- Limitadores para a tabela `tbl_notasfinais`
--
ALTER TABLE `tbl_notasfinais`
  ADD CONSTRAINT `fk_id_disciplina3` FOREIGN KEY (`id_disciplina`) REFERENCES `tbl_disciplina` (`id_disciplina`),
  ADD CONSTRAINT `fk_id_estudante3` FOREIGN KEY (`id_estudante`) REFERENCES `tbl_estudante` (`id_estudante`);

--
-- Limitadores para a tabela `tbl_notastrimestrais`
--
ALTER TABLE `tbl_notastrimestrais`
  ADD CONSTRAINT `fk_id_disciplina4` FOREIGN KEY (`id_disciplina`) REFERENCES `tbl_disciplina` (`id_disciplina`),
  ADD CONSTRAINT `fk_id_estudante4` FOREIGN KEY (`id_estudante`) REFERENCES `tbl_estudante` (`id_estudante`);

--
-- Limitadores para a tabela `tbl_permicaousuario`
--
ALTER TABLE `tbl_permicaousuario`
  ADD CONSTRAINT `fk_id_tipopermicao` FOREIGN KEY (`id_tipopermicao`) REFERENCES `tbl_tipopermicao` (`id_tipopermicao`),
  ADD CONSTRAINT `fk_id_usuario` FOREIGN KEY (`id_usuario`) REFERENCES `tbl_usuario` (`id_usuario`);

--
-- Limitadores para a tabela `tbl_pessoa`
--
ALTER TABLE `tbl_pessoa`
  ADD CONSTRAINT `fk_id_municipio` FOREIGN KEY (`id_municipio`) REFERENCES `tbl_municipio` (`id_municipio`),
  ADD CONSTRAINT `fk_id_provincia1` FOREIGN KEY (`id_provincia`) REFERENCES `tbl_provincia` (`id_provincia`);

--
-- Limitadores para a tabela `tbl_prova`
--
ALTER TABLE `tbl_prova`
  ADD CONSTRAINT `fk_id_disciplina6` FOREIGN KEY (`id_disciplina`) REFERENCES `tbl_disciplina` (`id_disciplina`),
  ADD CONSTRAINT `fk_id_estudante6` FOREIGN KEY (`id_estudante`) REFERENCES `tbl_estudante` (`id_estudante`);

--
-- Limitadores para a tabela `tbl_sala`
--
ALTER TABLE `tbl_sala`
  ADD CONSTRAINT `fk_id_tiposala` FOREIGN KEY (`id_tiposala`) REFERENCES `tbl_tiposala` (`id_tiposala`);

--
-- Limitadores para a tabela `tbl_senha`
--
ALTER TABLE `tbl_senha`
  ADD CONSTRAINT `fk_id_usuario1` FOREIGN KEY (`id_usuario`) REFERENCES `tbl_usuario` (`id_usuario`);

--
-- Limitadores para a tabela `tbl_turma`
--
ALTER TABLE `tbl_turma`
  ADD CONSTRAINT `fk_id_classe1` FOREIGN KEY (`id_classe`) REFERENCES `tbl_classe` (`id_classe`),
  ADD CONSTRAINT `fk_id_curso2` FOREIGN KEY (`id_curso`) REFERENCES `tbl_curso` (`id_curso`),
  ADD CONSTRAINT `fk_id_turno1` FOREIGN KEY (`id_turno`) REFERENCES `tbl_turno` (`id_turno`);

--
-- Limitadores para a tabela `tbl_usuario`
--
ALTER TABLE `tbl_usuario`
  ADD CONSTRAINT `fk_id_funcionario2` FOREIGN KEY (`id_funcionario`) REFERENCES `tbl_funcionario` (`id_funcionario`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
