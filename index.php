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
$sql = "SELECT p.id, p.nome, p.quantidade, p.unidade, p.valor, p.categoria_id, c.nome AS categoria
        FROM produto p
        JOIN categoria c ON p.categoria_id = c.id";
$stmt = $conn->prepare($sql);
$stmt->execute();
$produtos = $stmt->fetchAll(PDO::FETCH_ASSOC);

// Carregar categorias
$sqlCat = "SELECT id, nome FROM categoria";
$stmtCat = $conn->prepare($sqlCat);
$stmtCat->execute();
$categorias = $stmtCat->fetchAll(PDO::FETCH_ASSOC);

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

            <select name="categoria_id" required>
                <option value="">Selecione a categoria</option>
                <?php foreach ($categorias as $categoria): ?>
                    <option value="<?= $categoria['id'] ?>">
                        <?= $categoria['id'] . ' - ' . htmlspecialchars($categoria['nome']) ?>
                    </option>
                <?php endforeach; ?>
            </select>

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
                    <div class="acao-container">

                        <form method="POST">
                            <input type="hidden" name="acao" value="atualizar">
                            <input type="hidden" name="id" value="<?= $produto['id'] ?>">

                            <input type="text" name="nome" value="<?= htmlspecialchars($produto['nome']) ?>" required>
                            <input type="number" name="quantidade" value="<?= $produto['quantidade'] ?>" required>
                            <input type="text" name="unidade" value="<?= htmlspecialchars($produto['unidade']) ?>" required>
                            <input type="number" name="valor" value="<?= $produto['valor'] ?>" step="0.01" min="0" required>

                            <select name="categoria_id" required>
                                <option value="">Selecione a categoria</option>
                                <?php foreach ($categorias as $categoria): ?>
                                    <option value="<?= $categoria['id'] ?>"
                                        <?= $categoria['id'] == $produto['categoria_id'] ? 'selected' : '' ?>>
                                        <?= $categoria['id'] . ' - ' . htmlspecialchars($categoria['nome']) ?>
                                    </option>
                                <?php endforeach; ?>
                            </select>

                            <button type="submit">Atualizar</button>
                        </form>

                        <form method="POST" onsubmit="return confirm('Tem certeza que deseja excluir?');">
                            <input type="hidden" name="acao" value="excluir">
                            <input type="hidden" name="id" value="<?= $produto['id'] ?>">
                            <button type="submit">Excluir</button>
                        </form>

                    </div>
                </td>
            </tr>
        <?php endforeach; ?>
    </table>

</body>

</html>
