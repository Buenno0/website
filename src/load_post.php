<?php
session_start();
require_once('../config/config.php');
require '../vendor/autoload.php';

use Carbon\Carbon;
date_default_timezone_set('America/Sao_Paulo');
Carbon::setLocale('pt_BR');

// Assume that the session contains user_id
$logged_in_user_id = isset($_SESSION['user_id']) ? $_SESSION['user_id'] : null;

$query = "SELECT post.*, user.name AS author_name, user.id AS author_id, COUNT(comment.id) AS comment_count, GROUP_CONCAT(post_image.image_path) AS images
FROM post
JOIN user ON post.user_id = user.id
LEFT JOIN comment ON post.id = comment.post_id
LEFT JOIN post_image ON post.id = post_image.post_id
GROUP BY post.id, user.name, user.id
ORDER BY post.created_at DESC";
$result = mysqli_query($conn, $query);

while ($row = mysqli_fetch_assoc($result)) {
    $created_at = Carbon::parse($row['created_at']);
    $now = Carbon::now();
    $timeMessage = $created_at->diffForHumans($now);
    $timeMessage = str_replace('antes', 'atrás', $timeMessage);
    $comment_count = $row['comment_count'];

    // Processar as imagens
    $images = $row['images'] ? explode(',', $row['images']) : [];
    $imageHtml = '';
    if (count($images) > 0) {
        if (count($images) > 1) {
            $imageHtml = '<div class="image-carousel">';
            foreach ($images as $index => $image) {
                $imageHtml .= "<div class=\"carousel-item\"><img src=\"{$image}\" class=\"post-image\" data-index=\"{$index}\"></div>";
            }
            $imageHtml .= '</div>';
            $imageHtml .= '<div class="carousel-nav"><button class="prev-btn">❮</button><span class="image-counter"></span><button class="next-btn">❯</button></div>';
        } else {
            $imageHtml = "<div class=\"single-image\"><img src=\"{$images[0]}\" class=\"post-image\"></div>";
        }
        $imageHtml .= '<div class="image-modal" style="display: none;"><span class="close-modal">&times;</span><img class="modal-content"></div>';
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
            <div class=\"post__text\">
                <p class=\"p-post\">{$row['content']}</p>
            </div>
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
        </div>
    </div>";
}
?>

<div id="reportModal" class="modal" data-logged-in="<?=$is_logged_in?>" style="display: none;">
    <div class="modal-content">
        <span class="close">&times;</span>
        <h2 class="h2-report">Denunciar Postagem</h2>
        <form id="reportForm">
            <input type="hidden" id="reportPostId" name="post_id">
            <label for="reportReason">Motivo:</label>
            <select id="reportReason" name="reason" required>
                <option value="spam">Spam</option>
                <option value="Violência">Violência</option>
                <option value="Assédio">Assédio</option>
                <option value="Discurso de ódio">Discurso de ódio</option>
                <option value="Desinformação">Desinformação</option>
                <option value="other">Outro</option>
            </select>
            <button class="modal-button">Denunciar</button>
        </form>
        <div class="report-text">
            <span class="span-report">
                Agradecemos por sua denúncia. Gostaríamos de informar que todas as denúncias recebidas são tratadas com a máxima seriedade por nossa equipe. Assim que uma denúncia é recebida, iniciamos imediatamente uma investigação para verificar sua veracidade.
                <br>
                Caso a denúncia seja comprovada, o conteúdo em questão será removido do site conforme nossas políticas e diretrizes. No entanto, se a denúncia não for substanciada durante nossa investigação, o conteúdo permanecerá publicado.
                <br>
                Agradecemos sua colaboração.
            </span>
        </div>
    </div>
</div>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
$(document).ready(function() {
    function linkify(text) {
        var urlPattern = /(\b(https?|ftp|file):\/\/[-A-Z0-9+&@#\/%?=~_|!:,.;]*[-A-Z0-9+&@#\/%=~_|])/ig;
        return text.replace(urlPattern, '<a href="$1" class="post-link" target="_blank">$1</a>');
    }

    // Aplicar a função linkify ao conteúdo de cada post
    $('.p-post').each(function() {
        var content = $(this).html();
        var linkedContent = linkify(content);
        $(this).html(linkedContent);
    });

    // Mostrar caixa de comentário ao clicar no botão de comentar
    $('.comment-button').click(function(e) {
        e.preventDefault();
        var isLoggedIn = $(this).attr('data-logged-in') === 'true';

        if (!isLoggedIn) {
            window.location.href = '/website/users/login.php';
            return;
        }

        $(this).closest('.post').find('.comment-box').show();
    });

    // Enviar comentário ao clicar no botão de enviar
    $('.comment-send').click(function() {
        var commentBox = $(this).closest('.comment-box');
        var comment = commentBox.find('.comment-text').val();
        var post_id = $(this).closest('.post').data('post-id');

        // Enviar comentário para o servidor via AJAX
        $.ajax({
            url: 'insert_comment.php',
            type: 'POST',
            data: {
                post_id: post_id,
                comment: comment
            },
            success: function(response) {
                console.log(response);

                commentBox.find('.comment-text').val('');
                commentBox.hide();

                var successMessage = commentBox.closest('.post').find('.success-message');
                successMessage.show();
                setTimeout(function() {
                    successMessage.hide();
                }, 1500);

                var commentCountElem = commentBox.closest('.post').find('.comment-count');
                var commentCount = parseInt(commentCountElem.text());
                commentCountElem.text(commentCount + 1);
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

    // Enviar denúncia ao servidor via AJAX
    $('#reportForm').submit(function(e) {
        e.preventDefault();
        var post_id = $('#reportPostId').val();
        var reason = $('#reportReason').val();

        $.ajax({
            url: 'report_post.php',
            type: 'POST',
            data: {
                post_id: post_id,
                reason: reason
            },
            success: function(response) {
                console.log(response);
                modal.hide();
                alert('Denúncia enviada com sucesso!');
            },
            error: function(xhr, status, error) {
                console.error('Erro ao enviar denúncia:', error);
            }
        });
    });

    // Inicializar o carrossel de imagens
    $('.image-carousel').each(function() {
        var carousel = $(this);
        var items = carousel.find('.carousel-item');
        var currentIndex = 0;
        var totalImages = items.length;

        var imageCounter = carousel.next('.carousel-nav').find('.image-counter');
        imageCounter.text((currentIndex + 1) + ' / ' + totalImages);

        function showItem(index) {
            items.hide();
            items.eq(index).show();
            imageCounter.text((index + 1) + ' / ' + totalImages);
        }

        showItem(currentIndex);

        carousel.next('.carousel-nav').find('.prev-btn').click(function() {
            currentIndex = (currentIndex - 1 + totalImages) % totalImages;
            showItem(currentIndex);
        });

        carousel.next('.carousel-nav').find('.next-btn').click(function() {
            currentIndex = (currentIndex + 1) % totalImages;
            showItem(currentIndex);
        });

        // Ampliar imagem ao clicar
        carousel.find('.post-image').click(function() {
            var src = $(this).attr('src');
            var modal = $(this).closest('.post').find('.image-modal');
            modal.find('.modal-content').attr('src', src);
            modal.show();
        });

        // Fechar modal
        $('.close-modal').click(function() {
            $(this).closest('.image-modal').hide();
        });
    });

    // Excluir postagem ao clicar no botão de excluir
    $('.delete-button').click(function(e) {
    e.preventDefault();
    var post_id = $(this).attr('data-post-id');

    if (confirm('Você tem certeza de que deseja excluir esta postagem?')) {
        // Enviar pedido para excluir postagem via AJAX
        $.ajax({
            url: 'delete_post.php',
            type: 'POST',
            data: { post_id: post_id },
            success: function(response) {
                try {
                    var result = JSON.parse(response);
                    if (result.success) {
                        // Remover o post do DOM
                        $('div.post[data-post-id="' + post_id + '"]').remove();
                        alert('Postagem excluída com sucesso!');
                    } else {
                        alert('Erro ao excluir postagem: ' + result.error);
                    }
                } catch (error) {
                    console.error('Erro ao processar resposta:', error);
                    alert('Erro inesperado. Por favor, tente novamente.');
                }
            },
            error: function(xhr, status, error) {
                console.error('Erro ao excluir postagem:', error);
                alert('Erro ao excluir postagem. Por favor, tente novamente.');
            }
        });
    }
});

});
</script>
