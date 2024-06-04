<?php
require_once('../config/config.php');
require '../vendor/autoload.php';

use Carbon\Carbon;
date_default_timezone_set('America/Sao_Paulo');
Carbon::setLocale('pt_BR');

session_start();
$user_id = $_SESSION['user_id'];

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $post_id = $_POST['post_id'];
    $comment = $_POST['comment'];

    // Inserir comentário no banco de dados
    $insert_query = "INSERT INTO comment (post_id, user_id, content, created_at) VALUES (?, ?, ?, NOW())";
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
                
                // Obter os detalhes do usuário
                $user_query = "SELECT name FROM user WHERE id = ?";
                if ($user_stmt = mysqli_prepare($conn, $user_query)) {
                    mysqli_stmt_bind_param($user_stmt, 'i', $user_id);
                    mysqli_stmt_execute($user_stmt);
                    mysqli_stmt_bind_result($user_stmt, $commenter_name);
                    mysqli_stmt_fetch($user_stmt);
                    mysqli_stmt_close($user_stmt);

                    $comment_created_at = Carbon::now();
                    $comment_time_message = $comment_created_at->diffForHumans();
                    $comment_time_message = str_replace('antes', 'atrás', $comment_time_message);

                    // Construir o HTML do novo comentário
                    $new_comment_html = "
                    <div class=\"comment custom-comment\">
                        <div class=\"comment__avatar custom-comment__avatar\">
                            <img class=\"avatar img\" src=\"../assets/user-profile.svg\">
                        </div>
                        <div class=\"comment__body custom-comment__body\">
                            <div class=\"comment__author custom-comment__author\">
                                <strong>{$commenter_name}</strong>
                                <time datetime=\"{$comment_created_at}\" class=\"post__date\">
                                    {$comment_time_message}
                                </time>
                            </div>
                            <p class=\"p-post\">{$comment}</p>
                        </div>
                    </div>";

                    echo json_encode(array(
                        'comment_html' => $new_comment_html,
                        'comment_count' => $comment_count
                    ));
                } else {
                    echo json_encode(array('error' => 'Erro ao preparar a consulta do usuário: ' . mysqli_error($conn)));
                }
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
