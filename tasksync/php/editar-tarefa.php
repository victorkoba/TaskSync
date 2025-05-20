<?php
include 'conexao.php';

$id = $_GET['id'] ?? '';
$stmt = $conn->prepare("SELECT * FROM registros WHERE id = ?");
$stmt->bind_param("i", $id);
$stmt->execute();
$result = $stmt->get_result();
$registro = $result->fetch_assoc();

if (!$registro) {
    die("Registro não encontrado.");
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (!verifyCSRFToken($_POST['csrf_token'])) {
        die("CSRF inválido");
    }
    $novo_nome = $_POST['nome'];
    $stmt = $conn->prepare("UPDATE registros SET nome = ? WHERE id = ?");
    $stmt->bind_param("si", $novo_nome, $id);
    $stmt->execute();
    header("Location: index.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="../css/style.css">

</head>
<body>
<form method="POST">
    <input type="hidden" name="csrf_token" value="<?= htmlspecialchars(generateCSRFToken()) ?>"/>
    Tarefa: <input type="text" name="nome" value="<?= htmlspecialchars($registro['nome']) ?>" required/><br>
    <button type="submit">Atualizar</button>
</form>
</body>
</html>
