<?php
require_once('../config/config.php');


function password_is_valid($password) {
    // Remove espaços em branco no início e no final da senha
    $password = trim($password);

    // Verifica se a senha não está vazia e tem mais de 8 dígitos
    return !empty($password) && strlen($password) >= 8;
}

function name_is_valid($name) {
    // Remove espaços em branco no início e no final do nome do usuário
    $name = trim($name);

    // Verifica se o nome do usuário tem entre 3 e 15 caracteres
    if (strlen($name) < 3 || strlen($name) > 15) {
        return false;
    }
    
    // Verifica se o nome do usuário contém apenas letras, números, ponto (.) ou sublinhado (_)
    if (!preg_match('/^[a-zA-Z0-9._]+$/', $name)) {
        return false;
    }
    
    // Verifica se o nome do usuário contém pelo menos uma letra
    if (!preg_match('/[a-zA-Z]/', $name)) {
        return false;
    }
    
    return true;
}

function email_is_valid($email) {
    return filter_var($email, FILTER_VALIDATE_EMAIL);
}

function normalize_email($email) {
    // Converte o e-mail para minúsculas e remove pontos do nome do usuário
    list($username, $domain) = explode('@', $email);
    $username = str_replace('.', '', $username);
    $email = $username . '@' . $domain;
    return strtolower($email);
}

function check_email($email) {
    global $conn;
    
    // Normaliza o e-mail antes de verificar no banco de dados
    $normalized_email = normalize_email($email);
    
    $sql = "SELECT * FROM user WHERE email = ?";
    $stmt = mysqli_prepare($conn, $sql);
    mysqli_stmt_bind_param($stmt, "s", $normalized_email);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
    $user = mysqli_fetch_assoc($result);
    mysqli_stmt_close($stmt);
    
    if ($user) {
        return true; 
    } else {
        return false; 
    }
}

function create_user($name, $password, $email) {
    global $conn;
    
    // Normaliza o e-mail antes de inserir no banco de dados
    $normalized_email = normalize_email($email);
    
    $sql = "INSERT INTO user (name, password, email) VALUES (?, ?, ?)";
    $stmt = mysqli_prepare($conn, $sql);
    mysqli_stmt_bind_param($stmt, "sss", $name, $hashed_password, $normalized_email);

    $hashed_password = password_hash($password, PASSWORD_DEFAULT);

    if (mysqli_stmt_execute($stmt)) {
        mysqli_stmt_close($stmt);
        return true; 
    } else {
        mysqli_stmt_close($stmt);
        return false; 
    }
}


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST["name"];
    $password = $_POST["password"];
    $email = $_POST["email"];

    $response = array();

    if (!name_is_valid($name)) {
        $response['success'] = false;
        $response['message'] = "Nome de usuário inválido. Deve ter entre 3 e 15 caracteres, conter apenas letras, números, ponto (.) ou sublinhado (_), deve conter pelo menos uma letra, e não deve conter espaços no início ou no final.";
        header('Content-Type: application/json');
        echo json_encode($response);
        exit();
    }

    if (!password_is_valid($password)) {
        $response['success'] = false;
        $response['message'] = "Senha inválida. Deve ter mais de 8 dígitos, não estar vazia e não conter espaços no início ou no final.";
        header('Content-Type: application/json');
        echo json_encode($response);
        exit();
    }

    if (!email_is_valid($email)) {
        $response['success'] = false;
        $response['message'] = "E-mail inválido.";
        header('Content-Type: application/json');
        echo json_encode($response);
        exit();
    }
    
    if (check_email($email)) {
        $response['success'] = false;
        $response['message'] = "E-mail já cadastrado.";
        header('Content-Type: application/json');
        echo json_encode($response);
        exit();
    }

    if (create_user($name, $password, $email)) {
        $response['success'] = true;
        $response['message'] = "Usuário criado com sucesso!";
    } else {
        $response['success'] = false;
        $response['message'] = "Erro ao criar usuário.";
    }

    header('Content-Type: application/json');
    echo json_encode($response);
    exit();
}
?>