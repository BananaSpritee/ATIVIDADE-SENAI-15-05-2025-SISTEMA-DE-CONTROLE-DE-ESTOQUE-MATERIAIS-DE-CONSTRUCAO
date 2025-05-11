<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['id'])) {
    $id = $_POST["id"];

    $sql = "DELETE FROM produto WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->execute([$id]);
}
?>
