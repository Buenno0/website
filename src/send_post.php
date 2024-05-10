<?php
session_start();
require_once('../config/config.php');

if($_SERVER["REQUEST_METHOD"] == "POST"){
    // Supondo que $user_id seja obtido de alguma forma válida
    $user_id = $_SESSION["user_id"]; // ou outra fonte confiável

    $texto = mysqli_real_escape_string($conn, $_POST['texto']);
    $query = "INSERT INTO post (content, created_at, user_id) VALUES (?, NOW(), ?)";

    if($stmt = mysqli_prepare($conn, $query)){
        mysqli_stmt_bind_param($stmt, "si", $texto, $user_id);
        $result = mysqli_stmt_execute($stmt);
        if(!$result){
            // Lidar com erro de execução da consulta
            echo "Erro ao inserir o post: " . mysqli_error($conn);
        }
        mysqli_stmt_close($stmt);
    } else {
        // Lidar com erro de preparação da consulta
        echo "Erro ao preparar a consulta: " . mysqli_error($conn);
    }
}
?>
