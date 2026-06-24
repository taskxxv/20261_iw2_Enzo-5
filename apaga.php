<?php
include 'conecta.php';

header('Content-Type: application/json');

$id = isset($_POST['id']) ? (int) $_POST['id'] : 0;

if ($id <= 0) {
    echo json_encode(['ok' => false, 'msg' => 'ID inválido.']);
    exit;
}

$stmt = $conn->prepare("DELETE FROM tb_camisetas WHERE cd_camiseta = :id");
$stmt->bindValue(':id', $id, PDO::PARAM_INT);

if ($stmt->execute()) {
    echo json_encode(['ok' => true]);
} else {
    echo json_encode(['ok' => false, 'msg' => 'Falha ao excluir.']);
}
?>