<?php
include 'conexao.php';

$id = $_GET['id'] ?? '';
$stmt = $conexao->prepare("SELECT * FROM tarefas WHERE id_tarefa = ?");
$stmt->bind_param("i", $id);
$stmt->execute();
$result = $stmt->get_result();
$tarefa = $result->fetch_assoc();

if (!$tarefa) {
    die("Tarefa não encontrada.");
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $descricao = $_POST['descricao'];
    $prioridade = $_POST['prioridade'];
    $status = $_POST['status'];
    $setor = $_POST['setor'];
    $data = $_POST['data'];

    $stmt = $conexao->prepare("UPDATE tarefas SET descricao_tarefa = ?, prioridade_tarefa = ?, status_tarefa = ?, setor_tarefa = ?, data_tarefa = ? WHERE id_tarefa = ?");
    $stmt->bind_param("sssssi", $descricao, $prioridade, $status, $setor, $data, $id);
    $stmt->execute();

    header("Location: visualizar-tarefas.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Tarefa</title>
    <link rel="stylesheet" href="../css/style.css">
</head>
<body class="editar-tarefa">
    <div class="container-editar">
        <h2 class="titulo-editar">Editar Tarefa</h2>
        <form method="POST" class="form-editar">
            <label>Descrição:</label>
            <input type="text" name="descricao" value="<?= htmlspecialchars($tarefa['descricao_tarefa']) ?>" required>

            <label>Prioridade:</label>
            <select name="prioridade" required>
                <option value="alta" <?= $tarefa['prioridade_tarefa'] === 'alta' ? 'selected' : '' ?>>Alta</option>
                <option value="media" <?= $tarefa['prioridade_tarefa'] === 'media' ? 'selected' : '' ?>>Média</option>
                <option value="baixa" <?= $tarefa['prioridade_tarefa'] === 'baixa' ? 'selected' : '' ?>>Baixa</option>
            </select>

            <label>Status:</label>
            <select name="status" required>
                <option value="aFazer" <?= $tarefa['status_tarefa'] === 'aFazer' ? 'selected' : '' ?>>A fazer</option>
                <option value="fazendo" <?= $tarefa['status_tarefa'] === 'fazendo' ? 'selected' : '' ?>>Fazendo</option>
                <option value="concluido" <?= $tarefa['status_tarefa'] === 'concluido' ? 'selected' : '' ?>>Concluída</option>
            </select>

            <label>Setor:</label>
            <select name="setor" required>
                <option value="rh" <?= $tarefa['setor_tarefa'] === 'rh' ? 'selected' : '' ?>>RH</option>
                <option value="manutencao" <?= $tarefa['setor_tarefa'] === 'manutencao' ? 'selected' : '' ?>>Manutenção</option>
                <option value="desenvolvedor" <?= $tarefa['setor_tarefa'] === 'desenvolvedor' ? 'selected' : '' ?>>Desenvolvedor</option>
                <option value="professor" <?= $tarefa['setor_tarefa'] === 'professor' ? 'selected' : '' ?>>Professor</option>
            </select>

            <label>Data:</label>
            <input type="date" name="data" value="<?= $tarefa['data_tarefa'] ?>" required>

            <div class="btn-container">
                <button type="submit" class="btn btn-salvar">Salvar Alterações</button>
                <a href="visualizar-tarefas.php" class="btn btn-cancelar">Cancelar</a>
            </div>
        </form>
    </div>
</body>
</html>