<?php
require_once('../config/config.php');

// Verifica se a requisição é POST
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Verifica se os dados necessários estão presentes
    if (isset($_POST['user_id']) && isset($_POST['action'])) {
        $user_id = intval($_POST['user_id']);
        $action = $_POST['action'];

        // Determina o novo tipo de usuário com base na ação
        if ($action === 'promote') {
            $new_user_type = 'adm';
        } elseif ($action === 'demote') {
            $new_user_type = 'comun';
        } else {
            echo json_encode(['status' => 'error', 'message' => 'Ação inválida.']);
            exit();
        }

        // Prepara e executa a consulta de atualização
        $sql = "UPDATE user SET user_type = ? WHERE id = ?";
        if ($stmt = $conn->prepare($sql)) {
            $stmt->bind_param('si', $new_user_type, $user_id);
            if ($stmt->execute()) {
                echo json_encode(['status' => 'success', 'message' => 'Tipo de usuário atualizado com sucesso.']);
            } else {
                echo json_encode(['status' => 'error', 'message' => 'Erro ao atualizar o tipo de usuário.']);
            }
            $stmt->close();
        } else {
            echo json_encode(['status' => 'error', 'message' => 'Erro ao preparar a consulta.']);
        }
    } else {
        echo json_encode(['status' => 'error', 'message' => 'Dados incompletos.']);
    }
} else {
    echo json_encode(['status' => 'error', 'message' => 'Método de requisição inválido.']);
}
?>
