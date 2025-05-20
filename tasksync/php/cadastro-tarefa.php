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
    $stmt->bind_param("sssss", $descricao, $prioridade, $status, $setor, $data);
    $stmt->execute();

    header('Location: visualizar-tarefas.php');
    exit();
}
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastro de Tarefas</title>
    <link rel="stylesheet" href="../css/style.css">
</head>
<body class="cadastro-tarefa">
    <div class="container-form">
        <h1 class="titulo-form">Cadastrar Nova Tarefa</h1>
        <form method="POST" class="form-tarefa">
            <label class="label-form" for="descricao">Descrição:</label>
            <input class="input-form" placeholder="Insira a descrição da tarefa" type="text" name="descricao" id="descricao" required>

            <label class="label-form" for="prioridade">Prioridade:</label>
            <select class="input-form" name="prioridade" id="prioridade" required>
                <option value="alta">Alta</option>
                <option value="media">Média</option>
                <option value="baixa">Baixa</option>
            </select>

            <label class="label-form" for="status">Status:</label>
            <select class="input-form" name="status" id="status" required>
                <option value="aFazer">A fazer</option>
                <option value="fazendo">Fazendo</option>
                <option value="concluido">Concluída</option>
            </select>

            <label class="label-form" for="setor">Setor:</label>
            <select class="input-form" name="setor" id="setor" required>
                <option value="rh">RH</option>
                <option value="manutencao">Manutenção</option>
                <option value="desenvolvedor">Desenvolvedor</option>
                <option value="professor">Professor</option>
            </select>

            <label class="label-form" for="data">Data:</label>
            <input class="input-form" type="date" name="data" id="data" required>

            <div class="alinhamento-button">
                <button class="button-entrar" type="submit">Cadastrar Tarefa</button>
            </div>
        </form>
    </div>
</body>
</html>
