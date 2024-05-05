<?php

require_once 'users/get_user_by_id.php'; 
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home</title>
</head>
<body>
<?php
session_start();

if (isset($_SESSION["user_id"]) && isset($_SESSION["user_name"])) {
    $id = $_SESSION["user_id"];
    $name = $_SESSION["user_name"];

    echo "ID do usuário: " . $id;
    echo "Nome do usuário: " . $name;
} else {
    echo "Usuário não está logado.";
}
?>
</body>
</html>
