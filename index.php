<?php

require "./includes/db.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST["acao"])) {
        switch ($_POST["acao"]) {
            case "inserir":
                require "./functions/inserir.php";
                break;
            case "atualizar":
                require "./functions/atualizar.php";
                break;
            case "excluir":
                require "./functions/excluir.php";
                break;
        }
    }
}

// Carregar produtos

$sql = "SELECT p.id, p.nome, p.quantidade, p.unidade, p.valor, c.nome AS categoria
        FROM produto p
        JOIN categoria c ON p.categoria_id = c.id";

$stmt = $conn->prepare($sql);

$stmt->execute();

$produtos = $stmt->fetchAll(PDO::FETCH_ASSOC);

?>

<!DOCTYPE html>

<html lang="pt-br">

<head>

    <meta charset="UTF-8">
    <title>Sistema de Estoque</title>
    <link rel="stylesheet" href="./css/style.css">

</head>

<body>

    <h1>Controle de Estoque - Materiais de Construção</h1>

    <div class="form-container">

        <h2>Inserir Novo Produto</h2>

        <form method="POST">

            <input type="hidden" name="acao" value="inserir">
            <input type="text" name="nome" placeholder="Nome do Produto" required>
            <input type="number" name="quantidade" placeholder="Quantidade" required>
            <input type="text" name="unidade" placeholder="Unidade (ex: kg, m², un)" required>
            <input type="number" name="valor" placeholder="Valor" step="0.01" min="0" required>
            <input type="number" name="categoria_id" placeholder="ID da Categoria" required>
            <button type="submit">Inserir Produto</button>

        </form>

    </div>

    <hr>

    <h2>Produtos Cadastrados</h2>

    <table>

        <tr>

            <th>ID</th>
            <th>Nome</th>
            <th>Quantidade</th>
            <th>Unidade</th>
            <th>Valor</th>
            <th>Categoria</th>
            <th>Ações</th>
        </tr>

        <?php foreach ($produtos as $produto): ?>
            <tr>

                <td><?= htmlspecialchars($produto['id']) ?></td>
                <td><?= htmlspecialchars($produto['nome']) ?></td>
                <td><?= htmlspecialchars($produto['quantidade']) ?></td>
                <td><?= htmlspecialchars($produto['unidade']) ?></td>
                <td><?= htmlspecialchars($produto['valor']) ?></td>
                <td><?= htmlspecialchars($produto['categoria']) ?></td>
                <td>

                    <form method="POST" style="display:inline-block;">
                        <input type="hidden" name="acao" value="atualizar">
                        <input type="hidden" name="id" value="<?= $produto['id'] ?>">
                        <input type="text" name="nome" value="<?= $produto['nome'] ?>" required>
                        <input type="number" name="quantidade" value="<?= $produto['quantidade'] ?>" required>
                        <input type="text" name="unidade" value="<?= $produto['unidade'] ?>" required>
                        <input type="number" name="valor" value="<?= $produto['valor'] ?>" step="0.01" min="0" required>
                        <input type="number" name="categoria_id" placeholder="ID da Categoria" required>
                        <button type="submit">Atualizar</button>
                    </form>

                    <form method="POST" style="display:inline-block;" onsubmit="return confirm('Tem certeza que deseja excluir?');">
                        <input type="hidden" name="acao" value="excluir">
                        <input type="hidden" name="id" value="<?= $produto['id'] ?>">
                        <button type="submit">Excluir</button>
                    </form>

                </td>

            </tr>
            
        <?php endforeach; ?>

    </table>

</body>

</html>