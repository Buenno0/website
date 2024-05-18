<?php
require_once('../config/config.php');

function normalize_email($email) {
    list($username, $domain) = explode('@', $email);
    $username = str_replace('.', '', $username);
    $email = $username . '@' . $domain;
    return strtolower($email);
}

function login_user($email, $password) {
    global $conn;

    $normalized_email = normalize_email($email);
    
    $sql = "SELECT id, name, user_type, password FROM user WHERE email = ?";
    $stmt = mysqli_prepare($conn, $sql);
    mysqli_stmt_bind_param($stmt, "s", $normalized_email);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_store_result($stmt); // Armazena o resultado da consulta

    // Verifica se a consulta retornou algum resultado
    if (mysqli_stmt_num_rows($stmt) == 1) {
        mysqli_stmt_bind_result($stmt, $id, $name, $user_type, $hashed_password);
        mysqli_stmt_fetch($stmt);

        if (password_verify($password, $hashed_password)) {
            session_start();
            $_SESSION["user_id"] = $id;
            $_SESSION["user_name"] = $name;
            $_SESSION["user_type"] = $user_type;
            $_SESSION["user_email"] = $normalized_email; // Armazena o e-mail na sessão
            mysqli_stmt_close($stmt);
            return true;
        }
    }

    mysqli_stmt_close($stmt);
    return false;
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST["email"];
    $password = $_POST["password"];
    $response = array();

    if (!login_user($email, $password)) {
        $response['success'] = false;
        $response['message'] = "E-mail ou senha inválidos.";
    } else {
        $response['success'] = true;
        $response['message'] = "Login bem-sucedido.";
    }

    header('Content-Type: application/json');
    echo json_encode($response);
    exit();
}
?>
