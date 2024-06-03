<?php
require_once('../config/config.php');

session_start();
$user_id = $_SESSION['user_id'];

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $post_id = $_POST['post_id'];
    $comment = $_POST['comment'];

    // Inserir comentário no banco de dados
    $insert_query = "INSERT INTO comment (post_id, user_id, content) VALUES (?, ?, ?)";
    if ($insert_stmt = mysqli_prepare($conn, $insert_query)) {
        mysqli_stmt_bind_param($insert_stmt, 'iis', $post_id, $user_id, $comment);
        $result = mysqli_stmt_execute($insert_stmt);
        mysqli_stmt_close($insert_stmt);

        if ($result) {
            // Obter a contagem atualizada de comentários
            $count_query = "SELECT COUNT(*) as comment_count FROM comment WHERE post_id = ?";
            if ($count_stmt = mysqli_prepare($conn, $count_query)) {
                mysqli_stmt_bind_param($count_stmt, 'i', $post_id);
                mysqli_stmt_execute($count_stmt);
                mysqli_stmt_bind_result($count_stmt, $comment_count);
                mysqli_stmt_fetch($count_stmt);
                mysqli_stmt_close($count_stmt);

                // Retornar a contagem atualizada de comentários
                $response = array('newCommentCount' => $comment_count);
                echo json_encode($response);
            } else {
                echo json_encode(array('error' => 'Erro ao preparar a consulta de contagem de comentários: ' . mysqli_error($conn)));
            }
        } else {
            echo json_encode(array('error' => 'Erro ao inserir o comentário: ' . mysqli_error($conn)));
        }
    } else {
        echo json_encode(array('error' => 'Erro ao preparar a consulta de inserção: ' . mysqli_error($conn)));
    }

    mysqli_close($conn);
}
?>
