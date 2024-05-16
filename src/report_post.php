<?php
require_once('../config/config.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $post_id = $_POST['post_id'];
    $reason = $_POST['reason'];

    $query = "INSERT INTO reports (post_id, reason) VALUES (?, ?)";
    $stmt = mysqli_prepare($conn, $query);
    mysqli_stmt_bind_param($stmt, 'is', $post_id, $reason);

    if (mysqli_stmt_execute($stmt)) {
        echo "Denúncia enviada com sucesso!";
    } else {
        echo "Erro ao enviar denúncia: " . mysqli_error($conn);
    }

    mysqli_stmt_close($stmt);
    mysqli_close($conn);
}

?>
