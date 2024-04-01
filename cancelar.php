<?php
session_start();

// Verificar se o administrador não está autenticado
if (!isset($_SESSION['admin_id'])) {
    // Se não estiver autenticado, redireciona para a página de login
    header("Location: administrador.php");
    exit;
}

include("conectadb.php");

// Verificar se o formulário de cancelamento foi enviado
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['cancelar_agendamento'])) {
    $id_agendamento = $_POST['id_agendamento'];
    $cliente_email = $_POST['cliente_email'];

    // Query preparada para cancelar o agendamento com base no ID fornecido e no email do cliente
    $sql_cancelar = "DELETE FROM agendamentos WHERE id = ? AND email = ?";
    
    // Preparar a declaração
    $stmt = mysqli_prepare($link, $sql_cancelar);
    
    // Vincular parâmetros
    mysqli_stmt_bind_param($stmt, "is", $id_agendamento, $cliente_email);
    
    // Executar a declaração
    if (mysqli_stmt_execute($stmt)) {
        echo "Agendamento cancelado com sucesso!";
    } else {
        echo "Erro ao cancelar o agendamento: " . mysqli_error($link);
    }
}

$sql = "SELECT * FROM agendamentos";
$resultado = mysqli_query($link, $sql);

if (mysqli_num_rows($resultado) > 0) {
    echo "<table>";
    echo "<tr><th>Nome</th><th>Email</th><th>Telefone</th><th>Data</th><th>Horário</th><th>Serviço</th><th>Barbeiro</th><th>Mensagem</th><th>Ação</th></tr>";
    
    while ($row = mysqli_fetch_assoc($resultado)) {
        echo "<tr>";
        echo "<td>" . $row["nome"] . "</td>";
        echo "<td>" . $row["email"] . "</td>";
        echo "<td>" . $row["telefone"] . "</td>";
        echo "<td>" . $row["data"] . "</td>";
        echo "<td>" . $row["horario"] . "</td>";
        echo "<td>" . $row["servico"] . "</td>";
        echo "<td>" . $row["barbeiro"] . "</td>";
        echo "<td>" . $row["mensagem"] . "</td>";
        echo "<td>
                <form method='POST'>
                    <input type='hidden' name='id_agendamento' value='" . $row['id'] . "'>
                    <input type='hidden' name='cliente_email' value='" . $row['email'] . "'>
                    <input type='submit' name='cancelar_agendamento' value='Cancelar'>
                </form>
              </td>";
        echo "</tr>";
    }
    echo "</table>";
} else {
    echo "Não há agendamentos.";
}

mysqli_close($link);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="cancelar.css">
    <title>Cancelamento</title>
</head>
<body>
    <form action="logout.php" method="post">
    </form>
</body>
</html>
