<?php
include("conectadb.php");

session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (!empty($_POST['username']) && !empty($_POST['password'])) {
        $username = mysqli_real_escape_string($link, $_POST['username']);
        $password = mysqli_real_escape_string($link, $_POST['password']);

        $sql = "SELECT id, nome FROM administradores WHERE nome = '$username' AND senha = '$password'";
        $result = mysqli_query($link, $sql);

        if ($result && mysqli_num_rows($result) > 0) {
            $row = mysqli_fetch_assoc($result);
            $_SESSION['admin_id'] = $row['id'];
            $_SESSION['admin_username'] = $row['nome'];
            header("Location: cancelar.php"); // Redireciona para a página de cancelamento de agendamento
            exit;
        } else {
            $saudacao = "<p>Credenciais inválidas. Por favor, tente novamente.</p>";
        }
    } else {
        $saudacao = "<p>Por favor, preencha todos os campos.</p>";
    }
}

mysqli_close($link);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="administrador.css">
    <title>Administrador</title>
</head>
<body>
</body>
</html>
