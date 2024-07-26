<?php
require_once('../config/config.php');
require '../vendor/autoload.php';

use Carbon\Carbon;
date_default_timezone_set('America/Sao_Paulo');
Carbon::setLocale('pt_BR');

// Assume que a sessão contém user_id
session_start();
$logged_in_user_id = isset($_SESSION['user_id']) ? $_SESSION['user_id'] : null;

if (isset($_GET['post_id'])) {
    $postId = $_GET['post_id'];

    // Consulta para buscar post, usuário e comentários
    $query = "
        SELECT 
            post.*, 
            user.name AS author_name, 
            user.id AS author_id, 
            COUNT(DISTINCT comment.id) AS comment_count, 
            GROUP_CONCAT(DISTINCT post_image.image_path) AS images,
            GROUP_CONCAT(DISTINCT CONCAT(comment.id, '|', comment.content, '|', comment.created_at, '|', commenter.name) SEPARATOR '||') AS comments
        FROM post
        JOIN user ON post.user_id = user.id
        LEFT JOIN comment ON post.id = comment.post_id
        LEFT JOIN user AS commenter ON comment.user_id = commenter.id
        LEFT JOIN post_image ON post.id = post_image.post_id
        WHERE post.id = ?
        GROUP BY post.id, user.name, user.id";

    $stmt = $conn->prepare($query);
    $stmt->bind_param("i", $postId);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($row = $result->fetch_assoc()) {
        $created_at = Carbon::parse($row['created_at']);
        $now = Carbon::now();
        $timeMessage = $created_at->diffForHumans($now);
        $timeMessage = str_replace('antes', 'atrás', $timeMessage);
        $comment_count = $row['comment_count'];

        // Processar as imagens
        $images = $row['images'] ? explode(',', $row['images']) : [];
        $imageHtml = '';
        if (count($images) > 0) {
            $imageHtml = '<div class="image-column">';
            foreach ($images as $image) {
                $imageHtml .= "<div class=\"image-item\"><img src=\"{$image}\" class=\"post-image\"></div>";
            }
            $imageHtml .= '</div>';
        }
        $imageHtml .= '<div class="image-modal" style="display: none;"><span class="close-modal">&times;</span><img class="modal-content"></div>';

        // Processar os comentários
        $commentsHtml = '';
        if ($row['comments']) {
            $comments = explode('||', $row['comments']);
            foreach ($comments as $commentData) {
                list($commentId, $commentContent, $commentCreatedAt, $commenterName) = explode('|', $commentData);
                $commentTimeMessage = Carbon::parse($commentCreatedAt)->diffForHumans($now);
                $commentTimeMessage = str_replace('antes', 'atrás', $commentTimeMessage);
                $commentsHtml .= "
                <div class=\"comment custom-comment\">
                    <div class=\"comment__avatar custom-comment__avatar\">
                        <img class=\"avatar img\" src=\"../assets/user-profile.svg\">
                    </div>
                    <div class=\"comment__body custom-comment__body\">
                        <div class=\"comment__author custom-comment__author\">
                            <strong>{$commenterName}</strong>
                            <time datetime=\"{$commentCreatedAt}\" class=\"post__date\">
                                {$commentTimeMessage}
                            </time>
                        </div>
                        <p class=\"p-post\">{$commentContent}</p>
                    </div>
                </div>";
            }
        }

        $is_logged_in = isset($_SESSION['user_id']) ? 'true' : 'false';
        $is_author = $logged_in_user_id == $row['author_id'] ? 'true' : 'false';

        $reportOrDeleteButton = $is_author === 'true' ? "
        <div class=\"delete\">
            <a href=\"#apagar-post\" class=\"delete-button\" data-post-id=\"{$row['id']}\">
                <img class=\"delete__icon\" src=\"../assets/delete.svg\" alt=\"excluir\">
            </a>
        </div>
        " : "
        <div class=\"report\">
            <a href=\"#\" class=\"report-button\" data-logged-in=\"{$is_logged_in}\">
                <img class=\"report__icon\" src=\"../assets/report.svg\" alt=\"denunciar\">
            </a>
        </div>
        ";

        echo "
        <div class=\"post\" data-post-id=\"{$row['id']}\">
            <div class=\"avatar\">
                <img class=\"avatar img\" src=\"../assets/user-profile.svg\">
            </div>
            <div class=\"post__body\">
                <div class=\"post__author\">
                    <strong>{$row['author_name']}</strong>
                    <time datetime=\"{$timeMessage}\" class=\"post__date\">
                        {$timeMessage}
                    </time>
                </div>
                <a class=\"post__text\" href=\"#\">
                    <p class=\"p-post\">{$row['content']}</p>
                </a>
                {$imageHtml}
                <div class=\"post__actions\">
                    <a href=\"#\" class=\"comment-button\" data-logged-in=\"{$is_logged_in}\">
                        <img class=\"comment__icon\" src=\"../assets/comment.svg\" alt=\"comentar\" class=\"action-icon\">
                        <span class=\"comment-count\">{$comment_count}</span>
                    </a>
                    {$reportOrDeleteButton}
                </div>
                <div class=\"comment-box\" style=\"display: none;\">
                    <textarea class=\"comment-text\" placeholder=\"Escreva seu comentário\"></textarea>
                    <button class=\"comment-send\">Responder</button>
                </div>
                <div class=\"success-message\" style=\"display: none;\">
                    Comentário enviado com sucesso!
                </div>
                <div class=\"comments\">
                    {$commentsHtml}
                </div>
            </div>
        </div>";
    } else {
        echo '<p>Post não encontrado.</p>';
    }
} else {
    echo '<p>ID do post não fornecido.</p>';
}
?>
<script>
$(document).ready(function() {
    function initializePostFeatures() {
        // Linkify
        function linkify(text) {
            var urlPattern = /(\b(https?|ftp|file):\/\/[-A-Z0-9+&@#\/%?=~_|!:,.;]*[-A-Z0-9+&@#\/%=~_|])/ig;
            return text.replace(urlPattern, '<a href="$1" class="post-link" target="_blank">$1</a>');
        }
        
        $('.p-post').each(function() {
            var content = $(this).html();
            var linkedContent = linkify(content);
            $(this).html(linkedContent);
        });

        // Comentários
        $('.comment-button').click(function(e) {
            e.preventDefault();
            var isLoggedIn = $(this).attr('data-logged-in') === 'true';

            if (!isLoggedIn) {
                window.location.href = '/website/users/login.php';
                return;
            }

            $(this).closest('.post').find('.comment-box').show();
        });

        $('.comment-send').click(function() {
            var commentBox = $(this).closest('.comment-box');
            var comment = commentBox.find('.comment-text').val();
            var post_id = $(this).closest('.post').data('post-id');

            $.ajax({
                url: 'insert_comment.php',
                type: 'POST',
                data: {
                    post_id: post_id,
                    comment: comment
                },
                success: function(response) {
                    var jsonResponse = JSON.parse(response);
                    if (jsonResponse.error) {
                        console.error('Erro:', jsonResponse.error);
                    } else {
                        commentBox.find('.comment-text').val('');
                        commentBox.hide();

                        var successMessage = commentBox.closest('.post').find('.success-message');
                        successMessage.show();
                        setTimeout(function() {
                            successMessage.hide();
                        }, 1500);

                        var commentCountElem = commentBox.closest('.post').find('.comment-count');
                        commentCountElem.text(jsonResponse.comment_count);

                        // Adicionar o novo comentário à lista de comentários
                        commentBox.closest('.post').find('.comments').append(jsonResponse.comment_html);
                    }
                },
                error: function(xhr, status, error) {
                    console.error('Erro ao enviar comentário:', error);
                }
            });
        });

        // Modal de denúncia
        var modal = $('#reportModal');
        var span = $('.close');

        $('.report-button').click(function(e) {
            e.preventDefault();
            var isLoggedIn = $(this).attr('data-logged-in') === 'true';
            if (!isLoggedIn) {
                window.location.href = '/website/users/login.php';
                return;
            }
            var postId = $(this).closest('.post').data('post-id');
            $('#reportPostId').val(postId);
            modal.show();
        });

        span.click(function() {
            modal.hide();
        });

        $(window).click(function(event) {
            if ($(event.target).is(modal)) {
                modal.hide();
            }
        });

        $('#reportForm').submit(function(e) {
            e.preventDefault();
            var post_id = $('#reportPostId').val();
            var reason = $('#reportReason').val();

            $.ajax({
                url: 'insert_report.php',
                type: 'POST',
                data: {
                    post_id: post_id,
                    reason: reason
                },
                success: function(response) {
                    alert('Denúncia enviada com sucesso!');
                    modal.hide();
                },
                error: function(xhr, status, error) {
                    console.error('Erro ao enviar denúncia:', error);
                }
            });
        });

        // Modal de imagem
        $('.post-image').click(function() {
            var src = $(this).attr('src');
            var modal = $(this).closest('.post').find('.image-modal');
            modal.show();
            modal.find('.modal-content').attr('src', src);
        });

        $('.close-modal').click(function() {
            var modal = $(this).closest('.image-modal');
            modal.hide();
        });

        $(window).click(function(event) {
            if ($(event.target).hasClass('image-modal')) {
                $(event.target).hide();
            }
        });

        // Botão de apagar
        $('.delete-button').click(function(e) {
            e.preventDefault();
            var postId = $(this).data('post-id');
            var confirmation = confirm("Tem certeza de que deseja excluir este post?");
            if (confirmation) {
                $.ajax({
                    url: 'delete_post.php',
                    type: 'POST',
                    data: {
                        post_id: postId
                    },
                    success: function(response) {
                        alert('Post excluído com sucesso!');
                        location.reload();
                    },
                    error: function(xhr, status, error) {
                        console.error('Erro ao excluir post:', error);
                    }
                });
            }
        });
    }

    initializePostFeatures();
});
</script>
