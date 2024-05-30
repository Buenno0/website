<?php
session_start();
require_once('../config/config.php');

// Verificar se o usuário está logado
if (!isset($_SESSION['user_id'])) {
    echo json_encode(['success' => false, 'error' => 'Usuário não está logado']);
    exit;
}

// Obter o ID do post a ser deletado
$post_id = isset($_POST['post_id']) ? intval($_POST['post_id']) : null;

// Verificar se o post_id foi fornecido
if (!$post_id) {
    echo json_encode(['success' => false, 'error' => 'ID do post não fornecido']);
    exit;
}

// Verificar se o usuário logado é o autor do post
$user_id = $_SESSION['user_id'];
$query = "SELECT * FROM post WHERE id = ? AND user_id = ?";
$stmt = $conn->prepare($query);
$stmt->bind_param('ii', $post_id, $user_id);
$stmt->execute();
$result = $stmt->get_result();
$post = $result->fetch_assoc();

if (!$post) {
    echo json_encode(['success' => false, 'error' => 'Postagem não encontrada ou o usuário não tem permissão para excluir']);
    exit;
}

// Excluir imagens associadas ao post
$query = "SELECT image_path FROM post_image WHERE post_id = ?";
$stmt = $conn->prepare($query);
$stmt->bind_param('i', $post_id);
$stmt->execute();
$result = $stmt->get_result();

while ($row = $result->fetch_assoc()) {
    $image_path = $row['image_path'];
    if (file_exists($image_path)) {
        unlink($image_path); // Excluir o arquivo de imagem do servidor
    }
}

$query = "DELETE FROM reports WHERE post_id = ?";
$stmt = $conn->prepare($query);
$stmt->bind_param('i', $post_id);
$stmt->execute();
$result = $stmt->get_result();


// Excluir entradas da tabela post_image
$query = "DELETE FROM post_image WHERE post_id = ?";
$stmt = $conn->prepare($query);
$stmt->bind_param('i', $post_id);
$stmt->execute();

// Excluir comentários associados ao post
$query = "DELETE FROM comment WHERE post_id = ?";
$stmt = $conn->prepare($query);
$stmt->bind_param('i', $post_id);
$stmt->execute();

// Excluir o post
$query = "DELETE FROM post WHERE id = ?";
$stmt = $conn->prepare($query);
$stmt->bind_param('i', $post_id);
$stmt->execute();

if ($stmt->affected_rows > 0) {
    echo json_encode(['success' => true]);
} else {
    echo json_encode(['success' => false, 'error' => 'Erro ao excluir postagem']);
}

$stmt->close();
$conn->close();
?>
