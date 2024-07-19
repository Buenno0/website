<?php
require_once('../config/config.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $postId = $_POST['post_id'];

    // Iniciar a transação
    $conn->begin_transaction();

    try {
        // Deletar imagens relacionadas à postagem
        $sqlImages = "DELETE FROM post_image WHERE post_id = ?";
        $stmtImages = $conn->prepare($sqlImages);
        $stmtImages->bind_param('i', $postId);
        $stmtImages->execute();
        $stmtImages->close();

        // Deletar comentários relacionados à postagem
        $sqlComments = "DELETE FROM comment WHERE post_id = ?";
        $stmtComments = $conn->prepare($sqlComments);
        $stmtComments->bind_param('i', $postId);
        $stmtComments->execute();
        $stmtComments->close();

        // Deletar denúncias relacionadas à postagem
        $sqlReports = "DELETE FROM reports WHERE post_id = ?";
        $stmtReports = $conn->prepare($sqlReports);
        $stmtReports->bind_param('i', $postId);
        $stmtReports->execute();
        $stmtReports->close();

        // Deletar a postagem
        $sqlPost = "DELETE FROM post WHERE id = ?";
        $stmtPost = $conn->prepare($sqlPost);
        $stmtPost->bind_param('i', $postId);
        $stmtPost->execute();
        $stmtPost->close();

        // Confirmar a transação
        $conn->commit();
        
        echo json_encode(['status' => 'success', 'message' => 'Postagem deletada com sucesso.']);
    } catch (Exception $e) {
        // Reverter a transação em caso de erro
        $conn->rollback();
        
        echo json_encode(['status' => 'error', 'message' => 'Erro ao deletar a postagem.']);
    }
}

$conn->close();
?>
