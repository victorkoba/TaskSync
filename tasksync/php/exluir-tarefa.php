<?php
include 'conexao.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST'){

    $id = $_POST['id'] ?? '';
    echo "$id";
    $stmt = $conn->prepare("DELETE FROM tarefas WHERE id_tarefa = ?");
    $stmt->bind_param("i", $id);
    $stmt->execute();

    if ($stmt->affected_rows === 1) {
        header("Location: index.php");
        exit();
    } else {
    
    }
} else {
    echo "Não entrou no post";
}