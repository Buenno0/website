<?php

require_once('../config/config.php');
$query = "SELECT post.*, user.name AS author_name FROM post JOIN user ON post.user_id = user.id ORDER BY post.created_at DESC";
$result = mysqli_query($conn, $query);

while ($row = mysqli_fetch_assoc($result)) {
    echo "<div class=\"comment\">
    <div class=\"avatar\">
        <img class=\"avatar\" src=\"../assets/user-profile.svg\">
    </div>
    <div class=\"comment__body\">
        <div class=\"comment__author\">
            " . $row['author_name'] . "
            <time datetime=\"" . $row['created_at'] . "\" class=\"comment__date\">
                " . $row['created_at'] . "
            </time>
        </div>
        <div class=\"comment__text\">
            <p>" . $row['content'] . "</p>
        </div>
    </div>
</div>";
}

?>
