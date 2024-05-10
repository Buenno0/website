<?php
require_once('../config/config.php');
require '../vendor/autoload.php'; // Certifique-se de ter o autoload do Composer configurado

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

    echo "<div class=\"comment\">
    <div class=\"avatar\">
        <img class=\"avatar\" src=\"../assets/user-profile.svg\">
    </div>
    <div class=\"comment__body\">
        <div class=\"comment__author\">
            " . $row['author_name'] . "
            <time datetime=\"" . $timeMessage  . "\" class=\"comment__date\">
                " . $timeMessage. "
            </time>
        </div>
        <div class=\"comment__text\">
            <p>" . $row['content'] . "</p>
        </div>
    </div>
</div>";
}
?>
