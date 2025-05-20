<?php
include 'conexao.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST'){

    $id = isset($_POST['id_tarefa']) ? $_POST['id_tarefa'] : null;
    $sql = "DELETE FROM tarefas WHERE id_tarefa = ?";
    $stmt = $conexao->prepare($sql);
    $stmt->bind_param("i", $id);
    $stmt->execute();

    if ($stmt->affected_rows === 1) {
        header("Location: visualizar-tarefas.php");
        exit();
    } else {
    
    }
} else {
    echo "Não entrou no post";
}