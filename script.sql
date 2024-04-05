CREATE TABLE `agendamentos` (
  `id` int(11) NOT NULL,
  `nome` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `telefone` varchar(20) NOT NULL,
  `data` date NOT NULL,
  `horario` time NOT NULL,
  `servico` varchar(255) NOT NULL,
  `barbeiro` varchar(255) NOT NULL,
  `mensagem` text DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `servico_concluido` tinyint(1) NOT NULL DEFAULT 0
)

CREATE TABLE `administradores` (
  `id` int(11) NOT NULL,
  `nome` varchar(255) NOT NULL,
  `senha` varchar(255) NOT NULL
)

INSERT INTO `administradores` (`id`, `nome`, `senha`) VALUES
(1, 'admin', 'admin1234');

CREATE TABLE `funcionarios` (
  `id` int(11) NOT NULL,
  `nome` varchar(50) NOT NULL,
  `senha` varchar(255) NOT NULL
)

INSERT INTO `funcionarios` (`id`, `nome`, `senha`) VALUES
(1, 'Eduard', '1234'),
(2, 'Taylor', '12345');