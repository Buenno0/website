<?php
require_once('../config/config.php');
require_once('../vendor/autoload.php');

use Carbon\Carbon;

$query = "SELECT post.*, user.name AS author_name FROM post JOIN user ON post.user_id = user.id ORDER BY post.created_at DESC";
$result = mysqli_query($conn, $query);

while ($row = mysqli_fetch_assoc($result)) {
  $created_at = Carbon::createFromFormat('Y-m-d H:i:s', $row['created_at']);
  echo $created_at;
  $now = Carbon::now('America/Sao_Paulo');

  $time_message = $created_at->diffForHumans($now);


  
  




  

}



?>
