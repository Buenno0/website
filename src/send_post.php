<?php
session_start();
require_once('../config/config.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $user_id = $_SESSION["user_id"];
    $texto = $_POST['texto'];

    $query = "INSERT INTO post (content, created_at, user_id) VALUES (?, NOW(), ?)";
    
    if ($stmt = mysqli_prepare($conn, $query)) {
        mysqli_stmt_bind_param($stmt, "si", $texto, $user_id);
        $result = mysqli_stmt_execute($stmt);
        if ($result) {
            $post_id = mysqli_insert_id($conn); // Obtém o ID do post inserido

            // Tratamento das imagens
            $image_paths = [];
            if (!empty($_FILES['images']['name'][0])) {
                $total_images = count($_FILES['images']['name']);
                for ($i = 0; $i < $total_images; $i++) {
                    $image_name = $_FILES['images']['name'][$i];
                    $image_tmp_name = $_FILES['images']['tmp_name'][$i];
                    $image_size = $_FILES['images']['size'][$i];
                    $image_error = $_FILES['images']['error'][$i];
                    $image_ext = pathinfo($image_name, PATHINFO_EXTENSION);
                    $allowed = ['jpg', 'jpeg', 'png', 'gif'];

                    if (in_array($image_ext, $allowed)) {
                        if ($image_error === 0) {
                            if ($image_size <= 5000000) { // 5MB máximo
                                $image_new_name = uniqid('', true) . "." . $image_ext;
                                $image_destination = 'post_img/' . $image_new_name;
                                if (move_uploaded_file($image_tmp_name, $image_destination)) {
                                    $image_paths[] = $image_destination;
                                    
                                    // Inserir o caminho da imagem no banco de dados
                                    $image_query = "INSERT INTO post_image (post_id, image_path) VALUES (?, ?)";
                                    if ($image_stmt = mysqli_prepare($conn, $image_query)) {
                                        mysqli_stmt_bind_param($image_stmt, "is", $post_id, $image_destination);
                                        mysqli_stmt_execute($image_stmt);
                                        mysqli_stmt_close($image_stmt);
                                    }
                                }
                            }
                        }
                    }
                }
            }

            echo "Postagem enviada com sucesso!";
        } else {
            echo "Erro ao inserir o post: " . mysqli_error($conn);
        }
        mysqli_stmt_close($stmt);
    } else {
        echo "Erro ao preparar a consulta: " . mysqli_error($conn);
    }
}
?>
