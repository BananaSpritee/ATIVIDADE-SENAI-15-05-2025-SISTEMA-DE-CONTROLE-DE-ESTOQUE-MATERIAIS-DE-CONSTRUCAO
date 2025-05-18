<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['nome'], $_POST['quantidade'], $_POST['unidade'], $_POST['valor'], $_POST['categoria_id'])) {

    $sql = ("INSERT INTO produto (nome, quantidade, unidade, valor, categoria_id) VALUES (:nome, :quantidade, :unidade, :valor, :categoria_id)");
    $stmt = $conn->prepare($sql);

    $nome = $_POST["nome"];
    $quantidade = $_POST["quantidade"];
    $unidade = $_POST["unidade"];
    $valor = $_POST["valor"];
    $categoria_id = $_POST["categoria_id"];


    $stmt->bindParam(':nome', $nome);
    $stmt->bindParam(':quantidade', $quantidade);
    $stmt->bindParam(':unidade', $unidade);
    $stmt->bindParam(':valor', $valor);
    $stmt->bindParam(':categoria_id', $categoria_id);

    $stmt->execute();

}
?>
