<?php
require 'conexao.php';

$result = mysqli_query($conexao, "SELECT * FROM tarefas ORDER BY id_tarefa DESC");

$tarefas = [];
if ($result && mysqli_num_rows($result) > 0) {
    $tarefas = mysqli_fetch_all($result, MYSQLI_ASSOC);
}
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lista de Tarefas</title>
    <link rel="stylesheet" href="../css/style.css">
</head>
<body class="visualizar-tarefa">
    <div class="container-lista">
        <div class="top-bar">
            <a href="cadastro-tarefa.php" class="btn btn-nova">Nova Tarefa</a>
            <a href="logout.php" class="btn btn-sair">Sair</a>
        </div>

        <h2 class="titulo-lista">Lista de Tarefas</h2>

        <table class="tabela-tarefas">
            <thead>
                <tr>
                    <th>Descrição</th>
                    <th>Prioridade</th>
                    <th>Status</th>
                    <th>Setor</th>
                    <th>Data</th>
                    <th>Ações</th>
                </tr>
            </thead>
            <tbody>
            <?php if (!empty($tarefas)): ?>
                <?php foreach ($tarefas as $tarefa): ?>
                <tr>
                    <td><?= htmlspecialchars($tarefa['descricao_tarefa']) ?></td>
                    <td><?= htmlspecialchars($tarefa['prioridade_tarefa']) ?></td>
                    <td><?= htmlspecialchars($tarefa['status_tarefa']) ?></td>
                    <td><?= htmlspecialchars($tarefa['setor_tarefa']) ?></td>
                    <td><?= htmlspecialchars($tarefa['data_tarefa']) ?></td>
                    <td class="col-acoes">
                        <a class="btn btn-editar" href="editar-tarefa.php?id=<?= $tarefa['id_tarefa'] ?>">Editar</a>
                        <form class="excluir-form" method="POST" action="excluir-tarefa.php" onsubmit="return confirm('Tem certeza que deseja excluir?')">
                            <input type="hidden" name="id_tarefa" value="<?= $tarefa['id_tarefa'] ?>">
                            <button type="submit" class="btn btn-excluir">Excluir</button>
                        </form>
                    </td>
                </tr>
                <?php endforeach; ?>
            <?php else: ?>
                <tr><td colspan="6" class="sem-tarefa">Nenhuma tarefa encontrada.</td></tr>
            <?php endif; ?>
            </tbody>
        </table>
    </div>
</body>
</html>
