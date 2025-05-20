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
    <title>Cadastro de Tarefas</title>
    <link rel="stylesheet" href="../css/style.css">
</head>
<body>
    <div class="container">
        <div class="top-bar">
            <a href="cadastro-tarefa.php" class="btn">Nova Tarefa</a>
            <a href="logout.php" class="btn logout">Sair</a>
        </div>

        <h2 id="titulo-lista">Lista de Tarefas</h2>
        <table class="table-tr" class="th-table"  class="elementos-t-lista" id="tabela-lista">
            <tr class="table-tr" class="elementos-t-lista">
                <th class="th-table" class="elementos-t-lista">Descrição</th>
                <th class="th-table" class="elementos-t-lista">Prioridade</th>
                <th class="th-table" class="elementos-t-lista">Status</th>
                <th class="th-table" class="elementos-t-lista">Setor</th>
                <th class="th-table" class="elementos-t-lista">Data</th>
                <th class="th-table" class="elementos-t-lista">Ações</th>
            </tr>
            <?php if (!empty($tarefas)): ?>
                <?php foreach ($tarefas as $r): ?>
                <tr class="table-tr" class="elementos-t-lista">
                    <td class="elementos-t-lista"><?= htmlspecialchars($r['descricao']) ?></td>
                    <td class="elementos-t-lista"><?= htmlspecialchars($r['prioridade']) ?></td>
                    <td class="elementos-t-lista"><?= htmlspecialchars($r['status']) ?></td>
                    <td class="elementos-t-lista"><?= htmlspecialchars($r['setor']) ?></td>
                    <td class="elementos-t-lista"><?= htmlspecialchars($r['data']) ?></td>
                    <td class="elementos-t-lista">
                        <a class="btn" href="editar-tarefa.php?id=<?= $r['id_tarefa'] ?>">Editar</a>
                        <form class="excluir-form" method="POST" action="excluir-tarefa.php" onsubmit="return confirm('Tem certeza que deseja excluir?')" style="display:inline;">
                            <input type="hidden" name="id" value="<?= $r['id_tarefa'] ?>">
                            <button type="submit" class="btn-excluir">Excluir</button>
                        </form>
                    </td>
                </tr>
                <?php endforeach; ?>
            <?php else: ?>
                <tr class="table-tr"><td colspan="6">Nenhuma tarefa encontrada.</td></tr>
            <?php endif; ?>
        </table>
    </div>
</body>
</html>
