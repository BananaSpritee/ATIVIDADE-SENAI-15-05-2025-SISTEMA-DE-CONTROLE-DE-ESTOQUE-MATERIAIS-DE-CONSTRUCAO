<?php

require("./includes/db.php");

?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sistema de Controle de Estoque</title>
    <link rel="stylesheet" href="./css/style.css">
</head>

<body>
    <h1>Cadastro Produtos</h1>
    <form action="POST">
        <input type="text" id="nome_produto" name="nome_produto" placeholder="Nome Produto"></input><br>
        <input type="text" id="qtd_produto" name="qtd_produto" placeholder="Quantidade do Produto"></input><br>
        <input type="text" id="unidade_produto" name="unidade_produto" placeholder="Unidades do Produto"></input><br>
        <input type="text" id="valor_produto" name="valor_produto" placeholder="Valor do Produto"></input><br>
    </form>
    <hr>
</body>

</html>