<?php
require_once('../config/config.php');
require '../vendor/autoload.php';

use Carbon\Carbon;

date_default_timezone_set('America/Sao_Paulo');
Carbon::setLocale('pt_BR');

$query = "SELECT post.*, user.name AS author_name FROM post JOIN user ON post.user_id = user.id ORDER BY post.created_at DESC";
$result = mysqli_query($conn, $query);

while ($row = mysqli_fetch_assoc($result)) {
    $created_at = Carbon::parse($row['created_at']);
    $now = Carbon::now();
    $timeMessage = $created_at->diffForHumans($now);
    $timeMessage = str_replace('antes', 'atrás', $timeMessage);

    echo "
    <div class=\"post\">
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
                <a href=\"#\">
                    <img class=\"comment__icon\" src=\"../assets/comment.svg\" alt=\"comentar\" class=\"action-icon\">
                </a>
                <div class=\"report\">
                    <a href=\"#\">
                        <img class=\"report__icon\" src=\"../assets/report.svg\" alt=\"denunciar\" class=\"action-icon report-icon\">
                    </a>
                </div>
            </div>
            <div class=\"comment-box\" style=\"display: none;\">
                <textarea class=\"comment-text\" placeholder=\"Digite seu comentário\"></textarea>
                <button class=\"comment-send\">Enviar</button>
            </div>
        </div>
    </div>";
}
?>
<script>
    $(document).ready(function(){
    // Mostrar caixa de comentário ao clicar no botão de comentar
    $('.comment-button').click(function(){
        $('.comment-box').show();
    });

    // Enviar comentário ao clicar no botão de enviar
    $('.comment-send').click(function(){
        var comment = $('.comment-text').val();
        // Faça algo com o comentário, como enviar para o servidor via AJAX
        console.log(comment);
        // Limpar caixa de texto após enviar o comentário
        $('.comment-text').val('');
        // Ocultar caixa de comentário após enviar o comentário
        $('.comment-box').hide();
    });
});

</script>