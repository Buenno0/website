<?php
session_start();
if (isset($_SESSION["user_id"]) && isset($_SESSION["user_name"])) {
    $id = $_SESSION["user_id"];
    $name = $_SESSION["user_name"];
}
?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="utf-8">
    <title>Dropdown Menu 01</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Red+Hat+Display&display=swap" rel="stylesheet">
    <style>
        .search-box {
            border: 1px solid #E5E5E5;
            border-radius: 5px;
            padding: 10px;
            display: flex;
            margin-left: 10%;
            width: 65%;
            background-color: white;


        }
        .form-search {
            display: flex;
            width: 100%;
            justify-content: flex-start;
        }
        .logout {
            color: #E3452F;
            text-decoration: none;
  
        }
    </style>
    <link rel="stylesheet" href="/website/style/style.css">
</head>
<header>
    <img class="logo" src="https://img2.gratispng.com/20180715/zio/kisspng-logo-font-flame-logo-5b4b2d7c3b73e0.2237387315316535002435.jpg" alt="logo" width="75" height="50">
    <form class="form-search" action="" method="post">
        <input type="text" class="search-box" placeholder="Pesquisar">
        <button style="display: none;">Botão</button>
    </form>

    <span class="navigation__group">
        <?php if (isset($id)) : ?>
            <img class="profile" src="/website/assets/user.svg" alt="profile pic">
        <?php else : ?>
            <a href="/website/users/create_account.php"><img class="profile" src="/website/assets/login.svg" alt="profile pic"></a>
        <?php endif; ?>
    </span>
    <div class="dropdown__wrapper hide dropdown__wrapper--fade-in none">
        <div class="dropdown__group">
            <div class="user-name">Mateus</div>
            <div class="email">mat.bueno7@gmail.com</div>
        </div>
        <hr class="divider">
        <nav>
            <ul>
                <li>
                    <img src="/website/assets/profile.svg" alt="Profile"> Minha Conta
                </li>
                <li>
                    <img src="/website/assets/settings.svg" alt="Settings"> Ajustes da Conta
                </li>
            </ul>
            <hr class="divider">
            <ul>
                <li>
                    <img src="assets/help.svg" alt="Help"> Ajuda
                </li>
            </ul>
            <hr class="divider">
            <ul>
            
                <li style="color: #E3452F;">
                    <img src="assets/logout.svg" alt="Log Out">
                    <a class="logout" href="/website/users/logout.php">Sair</a> 
                </li>
                
            </ul>
        </nav>
    </div>
</header>
<script src="/website/includes/script/dropdown.js"></script>