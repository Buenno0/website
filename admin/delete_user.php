<?php
require_once('../config/config.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $userId = $_POST['user_id'];

    $sql = "DELETE FROM user WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param('i', $userId);

    if ($stmt->execute()) {
        echo json_encode(['status' => 'success', 'message' => 'Usuário deletado com sucesso.']);
    } else {
        echo json_encode(['status' => 'error', 'message' => 'Erro ao deletar o usuário.']);
    }

    $stmt->close();
}
$conn->close();

