<?php
include 'conexao.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $descricao = $_POST['descricao'];
    $prioridade = $_POST['prioridade'];
    $status = $_POST['status'];
    $setor = $_POST['setor'];
    $data = $_POST['data'];

    $sql = "INSERT INTO tarefas (descricao_tarefa, prioridade_tarefa, status_tarefa, setor_tarefa, data_tarefa) VALUES (?, ? , ?, ?, ?)";
    $stmt = $conexao->prepare($sql);
    $stmt->bind_param("ssssd", $descricao, $prioridade, $status, $setor, $data);
    $stmt->execute();

    header('Location: visualizar-tarefas.php');
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastro de tarefas</title>
    <link rel="stylesheet" href="../css/style.css">
</head>
<body>  
    <form method="POST">
        <label class="label-form" name="" value="">Descrição:</label>
        <input placeholder="Insira a descrição da tarefa" type="text" name="descricao" required>
        <label class="label-form" name="" value="">Prioridade:</label>
        <select name="prioridade" id="" required>
            <option value="alta">Alta</option>
            <option value="media">Média</option>
            <option value="baixa">Baixa</option>
        </select>
        <label class="label-form" name="" value="">Status:</label>
        <select name="status" id="" required>
            <option value="aFazer">A fazer</option>
            <option value="fazendo">Fazendo</option>
            <option value="concluido">Concluída</option>
        </select>
        <label class="label-form" name="" value="">Setor:</label>
        <select name="setor" id="" required>
            <option value="rh">RH</option>
            <option value="manutencao">Manutenção</option>
            <option value="desenvolvedor">Desenvolvedor</option>
            <option value="professor">Professor</option>
        </select>
        <label class="label-form" name="" value="">Data:</label>
        <input type="date" name="data" required>
        <div class="alinhamento-button">
            <button class="button-entrar" type="submit">Cadastrar tarefa</button>
        </div>
    </form>
</body>