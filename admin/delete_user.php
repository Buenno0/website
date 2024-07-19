<?php
require_once('../config/config.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST' ) {
    $userId = $_POST['user_id'];

    // Iniciar a transação
    $conn->begin_transaction();

    try {
        // Deletar comentários feitos pelo usuário
        $sqlComments = "DELETE FROM comment WHERE user_id = ?";
        $stmtComments = $conn->prepare($sqlComments);
        $stmtComments->bind_param('i', $userId);
        $stmtComments->execute();
        $stmtComments->close();

        // Deletar denúncias feitas pelo usuário
        $sqlReports = "DELETE FROM reports WHERE post_id IN (SELECT id FROM post WHERE user_id = ?)";
        $stmtReports = $conn->prepare($sqlReports);
        $stmtReports->bind_param('i', $userId);
        $stmtReports->execute();
        $stmtReports->close();

        // Deletar imagens das postagens do usuário
        $sqlImages = "DELETE FROM post_image WHERE post_id IN (SELECT id FROM post WHERE user_id = ?)";
        $stmtImages = $conn->prepare($sqlImages);
        $stmtImages->bind_param('i', $userId);
        $stmtImages->execute();
        $stmtImages->close();

        // Deletar postagens do usuário
        $sqlPosts = "DELETE FROM post WHERE user_id = ?";
        $stmtPosts = $conn->prepare($sqlPosts);
        $stmtPosts->bind_param('i', $userId);
        $stmtPosts->execute();
        $stmtPosts->close();

        // Deletar o usuário
        $sqlUser = "DELETE FROM user WHERE id = ?";
        $stmtUser = $conn->prepare($sqlUser);
        $stmtUser->bind_param('i', $userId);
        $stmtUser->execute();
        $stmtUser->close();

        // Confirmar a transação
        $conn->commit();

        echo json_encode(['status' => 'success', 'message' => 'Usuário deletado com sucesso.']);
    } catch (Exception $e) {
        // Reverter a transação em caso de erro
        $conn->rollback();

        echo json_encode(['status' => 'error', 'message' => 'Erro ao deletar o usuário.']);
    }
}

$conn->close();
?>
