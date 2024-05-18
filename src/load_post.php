<?php
require_once('../config/config.php');
require '../vendor/autoload.php';

use Carbon\Carbon;
date_default_timezone_set('America/Sao_Paulo');
Carbon::setLocale('pt_BR');

$query = "SELECT post.*, user.name AS author_name, COUNT(comment.id) AS comment_count
FROM post
JOIN user ON post.user_id = user.id
LEFT JOIN comment ON post.id = comment.post_id
GROUP BY post.id, user.name
ORDER BY post.created_at DESC";
$result = mysqli_query($conn, $query);

while ($row = mysqli_fetch_assoc($result)) {
    $created_at = Carbon::parse($row['created_at']);
    $now = Carbon::now();
    $timeMessage = $created_at->diffForHumans($now);
    $timeMessage = str_replace('antes', 'atrás', $timeMessage);
    $comment_count = $row['comment_count'];

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
            <div class=\"post__actions\">
                <a href=\"#\" class=\"comment-button\">
                    <img class=\"comment__icon\" src=\"../assets/comment.svg\" alt=\"comentar\" class=\"action-icon\">
                    <span class=\"comment-count\">{$comment_count}</span>
                </a>
                <div class=\"report\">
                    <a href=\"#\" class=\"report-button\">
                        <img class=\"report__icon\" src=\"../assets/report.svg\" alt=\"denunciar\" class=\"action-icon report-icon\">
                    </a>
                </div>
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

<div id="reportModal" class="modal" style="display: none;">
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
            
    <button class="modal-button">
        Denunciar
    </button>

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
        // Mostrar caixa de comentário ao clicar no botão de comentar
        $('.comment-button').click(function(e) {
            e.preventDefault();
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
    });
</script>
