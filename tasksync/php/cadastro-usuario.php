<?php
include 'conexao.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = $_POST['email'];
    $senha = $_POST['senha'];

    $senha_hash = password_hash($senha, PASSWORD_DEFAULT);

    $sql_verifica = "SELECT id_usuario FROM usuarios WHERE email_usuario = ?";
    $stmt_verifica = $conexao->prepare($sql_verifica);
    $stmt_verifica->bind_param("s", $email);
    $stmt_verifica->execute();
    $stmt_verifica->store_result();

    if ($stmt_verifica->num_rows > 0) {
        echo "<!DOCTYPE html>
        <html lang='pt-br'>
        <head>
            <meta charset='UTF-8'>
            <script src='https://cdn.jsdelivr.net/npm/sweetalert2@11'></script>
        </head>
        <body>
            <script>
                Swal.fire({
                    icon: 'error',
                    title: 'Erro',
                    text: 'E-mail já cadastrado!'
                }).then(() => window.location.href = 'cadastro-usuario.php');
            </script>
        </body>
        </html>";
        exit;
    }

    $sql = "INSERT INTO usuarios (email_usuario, senha_usuario) VALUES (?, ?)";
    $stmt = $conexao->prepare($sql);

    if ($stmt) {
        $stmt->bind_param("ss", $email, $senha_hash);
        if ($stmt->execute()) {
            echo "<!DOCTYPE html>
            <html lang='pt-br'>
            <head>
                <meta charset='UTF-8'>
                <script src='https://cdn.jsdelivr.net/npm/sweetalert2@11'></script>
            </head>
            <body>
                <script>
                    Swal.fire({
                        icon: 'success',
                        title: 'Sucesso!',
                        text: 'Administrador cadastrado com sucesso!'
                    }).then(() => window.location.href = '../index.php'); // redireciona para login
                </script>
            </body>
            </html>";
        } else {
            echo "Erro ao cadastrar: " . $stmt->error;
        }
        $stmt->close();
    } else {
        echo "Erro na preparação da consulta.";
    }

    $stmt_verifica->close();
    $conexao->close();
}
?>


<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="../css/style.css">
        <title>Cadastro</title>
    </head>
    <body class="body-cadastro-login">
       <div class="container-cadastro-login">
        <form class="form-cadastro-login" action="" method="POST">
            <img class="logo-tasksync" src="../img/logo-tasksync.png" alt="">
            <h1 class="h1-login-cadastro">Criar uma conta</h1>
            <label class="label-form" for="email">Email:</label>
            <input class="input-form" type="email" id="email" name="email" required>
            <label class="label-form" for="senha">Senha:</label>
            <input class="input-form" type="password" id="senha" name="senha" required>
            <div class="alinhamento-button">
                <button class="button-entrar" type="submit">Cadastrar</button>
            </div>
            <a id="texto-cadastro" href="../index.php">Já tem cadastro? Entrar na sua conta</a>
        </form>
       </div>
    </body>
</html>