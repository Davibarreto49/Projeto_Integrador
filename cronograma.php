<?php
session_start(); // Inicia a sessão

// Verifica se o funcionário está autenticado
if (!isset($_SESSION['funcionario_id'])) {
    // Se não estiver autenticado, redireciona para a página de login
    header("Location: login.php");
    exit;
}

include("conectadb.php");

// Obtém o ID do funcionário logado
$funcionario_id = $_SESSION['funcionario_id'];

// Consulta SQL para selecionar os agendamentos do funcionário logado
$sql = "SELECT * FROM agendamentos WHERE barbeiro = $funcionario_id"; // Supondo que o campo 'barbeiro' na tabela 'agendamentos' represente o ID do funcionário responsável
$result = mysqli_query($link, $sql);

if ($result) {
    // Exibe o nome do funcionário
    echo "<h2>Bem-vindo, " . $_SESSION['funcionario_nome'] . "!</h2>";

    // Exibe os agendamentos em uma tabela
    echo "<h3>Cronograma de Funcionário</h3>";
    echo "<table border='1'>";
    echo "<tr><th>Cliente</th><th>Serviço</th><th>Data do Serviço</th><th>Hora do Serviço</th></tr>";
    while ($row = mysqli_fetch_assoc($result)) {
        echo "<tr>";
        echo "<td>" . $row['nome'] . "</td>"; // Exibe o nome do cliente
        echo "<td>" . $row['servico'] . "</td>"; // Exibe o serviço
        echo "<td>" . $row['data'] . "</td>"; // Exibe a data do serviço
        echo "<td>" . $row['horario'] . "</td>"; // Exibe o horário do serviço
        echo "</tr>";
    }
    echo "</table>";
} else {
    // Se ocorrer um erro na consulta, exibe uma mensagem de erro
    echo "Erro na consulta: " . mysqli_error($link);
}

// Fecha a conexão com o banco de dados
mysqli_close($link);
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="cronograma.css">
    <title>Cronograma</title>
</head>
<body>
    
</body>
</html>
