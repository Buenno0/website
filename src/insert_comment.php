<?php
require_once('../config/config.php');

session_start();
$user_id = $_SESSION['user_id']; 
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $post_id= $_POST['post_id'];
    $comment = $_POST['comment'];

    $query = "INSERT INTO comment (post_id, user_id, content) VALUES (?, ?, ?)";
    if ($stmt = mysqli_prepare($conn, $query)) {
        mysqli_stmt_bind_param($stmt, 'iis', $post_id, $user_id, $comment);
        $result = mysqli_stmt_execute($stmt);
        if (!$result) {
            echo 'Erro ao inserir o comentário: ' . mysqli_error($conn);
        }
        mysqli_stmt_close($stmt);
    } else {
        echo 'Erro ao preparar a consulta: ' . mysqli_error($conn);
    }
    mysqli_close($conn);
}
?>
