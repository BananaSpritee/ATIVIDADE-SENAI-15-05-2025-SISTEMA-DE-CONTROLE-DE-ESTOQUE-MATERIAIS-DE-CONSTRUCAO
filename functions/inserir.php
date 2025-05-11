<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['nome'], $_POST['quantidade'], $_POST['unidade'], $_POST['valor'], $_POST['categoria_id'])) {
    $nome = $_POST["nome"];
    $quantidade = $_POST["quantidade"];
    $unidade = $_POST["unidade"];
    $valor = $_POST["valor"];
    $categoria_id = $_POST["categoria_id"];

    $sql = "INSERT INTO produto (nome, quantidade, unidade, valor, categoria_id) VALUES (?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->execute([$nome, $quantidade, $unidade, $valor, $categoria_id]);
}
?>
