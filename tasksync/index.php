<?php
session_start();
include './php/conexao.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $email = $_POST['email'];
    $password = $_POST['senha'];

    $sql = "SELECT * FROM usuarios WHERE email_usuario = ?";
    $stmt = $conexao->prepare($sql);
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $user = $result->fetch_assoc();

        if (password_verify($password, $user['senha_usuario'])) {
            $_SESSION['usuario'] = $user['nome_usuario'];
            $_SESSION['id_usuario'] = $user['id'];
            $_SESSION['tipo'] = $user['type'];

            header('Location: ./php/visualizar-tarefas.php');
            exit;
        } else {
            echo "<script src='https://cdn.jsdelivr.net/npm/sweetalert2@11'></script>";
            echo "<script>
                    document.addEventListener('DOMContentLoaded', function(){
                        Swal.fire({
                            title: 'Senha incorreta!',
                            icon: 'warning',
                            confirmButtonText: 'OK'
                        }).then(function() {
                            window.location.href = 'index.php';
                        });
                    });
                </script>";
        }
    } else {
        echo "<script src='https://cdn.jsdelivr.net/npm/sweetalert2@11'></script>";
        echo "<script>
                document.addEventListener('DOMContentLoaded', function(){
                    Swal.fire({
                        title: 'Usuário não encontrado!',
                        icon: 'error', // Corrigido o ícone
                        confirmButtonText: 'Tente fazer um cadastro'
                    });
                });
            </script>";
    }

    $stmt->close();
    $conexao->close();
}
?>


<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="./css/style.css">
        <title>Login</title>
    </head>
    <body class="body-cadastro-login">
       <div class="container-cadastro-login">
        <form class="form-cadastro-login" action="" method="POST">
            <img class="logo-tasksync" src="./img/logo-tasksync.png" alt="">
            <h1 class="h1-login-cadastro">Entrar na sua conta</h1>
            <div class="linha"></div>
            <label class="label-form" for="email">Email:</label>
            <input class="input-form" type="email" id="email" name="email" required>
            <label class="label-form" for="senha">Senha:</label>
            <input class="input-form" type="password" id="senha" name="senha" required>
            <div class="alinhamento-button">
                <button class="button-entrar" type="submit">Entrar</button>
            </div>
            <a id="texto-cadastro" href="./php/cadastro-usuario.php">Não tem uma conta? Fazer seu cadastro</a>
        </form>
       </div>
    </body>
</html>