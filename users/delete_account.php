<?php
session_start();
require_once('../config/config.php');

// Função para verificar se o usuário está logado
function isUserLoggedIn() {
    return isset($_SESSION['user_id']);
}

// Verificar se o usuário está logado
if (!isUserLoggedIn()) {
    header("Location: /website/users/login.php");
    exit();
}

$user_id = $_SESSION['user_id'];

// Iniciar a transação
$conn->begin_transaction();

try {
    // Apagar comentários dos posts do usuário
    $query = "DELETE FROM comment WHERE post_id IN (SELECT id FROM post WHERE user_id = ?)";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("i", $user_id);
    $stmt->execute();

    // Apagar comentários do usuário
    $query = "DELETE FROM comment WHERE user_id = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("i", $user_id);
    $stmt->execute();

    // Apagar imagens dos posts do usuário
    $query = "DELETE FROM post_image WHERE post_id IN (SELECT id FROM post WHERE user_id = ?)";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("i", $user_id);
    $stmt->execute();

    // Apagar posts do usuário
    $query = "DELETE FROM post WHERE user_id = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("i", $user_id);
    $stmt->execute();

    // Apagar usuário
    $query = "DELETE FROM user WHERE id = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("i", $user_id);
    $stmt->execute();

    // Commit da transação
    $conn->commit();

    // Encerrar sessão
    session_unset();
    session_destroy();

    // Redirecionar para a página de login
    header("Location: /website/users/login.php");
    exit();
} catch (Exception $e) {
    // Reverter a transação em caso de erro
    $conn->rollback();
    echo "Erro ao encerrar a conta: " . $e->getMessage();
}

// Fechar a conexão com o banco de dados
$conn->close();
?>
