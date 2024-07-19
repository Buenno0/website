<?php
session_start();
if (isset($_SESSION["user_id"]) && isset($_SESSION["user_name"])) {
    $id = $_SESSION["user_id"];
    $name = $_SESSION["user_name"];
    $email = $_SESSION["user_email"];
    $user_type = $_SESSION["user_type"];
}
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Blog</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Red+Hat+Display&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@24,400,0,0" />
    <link href="https://fonts.googleapis.com/css2?family=Poppins&display=swap" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css2?family=Ubuntu+Sans:ital,wght@0,100..800;1,100..800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="/website/style/style.css">
</head>
<body>
<header>
    <a href="../index.php"><img class="logo" src="/website/assets/logo.png" alt="logo" width="105" height="80"></a>
    <nav>
        <ul class="nav-links">
            <li><a href="/website/index.php">Home</a></li>
            <li><a href="/website/src/blog.php">Blog</a></li>
            <li><a href="/website/about.php">Sobre</a></li>
            <li><a href="/website/contact.php">Contato</a></li>
        </ul>
    </nav>

    <span class="navigation__group">
        <?php if (isset($id)) : ?>
            <img class="profile" src="/website/assets/user.svg" alt="profile pic">
        <?php else : ?>
            <a href="/website/users/create_account.php"><img class="profile" src="/website/assets/login.svg" alt="profile pic"></a>
        <?php endif; ?>
    </span>
    <div class="dropdown__wrapper hide dropdown__wrapper--fade-in none">
        <div class="dropdown__group">
            <div class="user-name"><?=$name?></div>
            <div class="email"><?=$email?></div>
        </div>
        <hr class="divider">
        <nav>
            <ul>
                <li>
                    <img src="/website/assets/profile.svg" alt="Profile"><a class="a-menu" href="/website/users/my_account.php"> Minha Conta</a>
                </li>
                <?php if ($user_type == 'adm') : ?>
                    <li>
                        <img src="/website/assets/settings.svg" alt="Settings"><a class="a-menu" href="/website/admin/adm_dashboard.php"> Administração</a>
                    </li>
                <?php endif; ?>
            </ul>
            <hr class="divider">
            <ul>
                <li>
                    <img src="/website/assets/help.svg" alt="Help"> Ajuda
                </li>
            </ul>
            <hr class="divider">
            <ul>
                <li style="color: #E3452F;">
                    <img src="/website/assets/logout.svg" alt="Log Out">
                    <a class="logout" href="/website/users/logout.php">Sair</a> 
                </li>
            </ul>
        </nav>
    </div>
</header>
<script src="/website/includes/script/dropdown.js"></script>
</body>
</html>
