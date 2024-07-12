<?php
require_once('../includes/header.php');
require_once('../config/config.php');

// Função para verificar se o usuário está logado
function isUserLoggedIn() {
    return isset($_SESSION['user_id']);
}

// Função para verificar se a sessão é válida
function isSessionValid() {
    $session_duration = 1800; // 30 minutos
    if (isset($_SESSION['last_activity']) && (time() - $_SESSION['last_activity'] > $session_duration)) {
        session_unset();
        session_destroy();
        return false;
    }
    $_SESSION['last_activity'] = time(); // Atualiza o tempo de atividade
    return true;
}

// Função para verificar se o usuário tem permissão para acessar a página "Minha Conta"
function userHasPermission($conn) {
    $user_id = $_SESSION['user_id'];
    $query = "SELECT user_type FROM user WHERE id = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("i", $user_id);
    $stmt->execute();
    $result = $stmt->get_result();
    $user = $result->fetch_assoc();
    return $user && in_array($user['user_type'], ['adm', 'comun']);
}

// Verificar se o usuário está logado, a sessão é válida e o usuário tem permissão
if (!isUserLoggedIn() || !isSessionValid() || !userHasPermission($conn)) {
    header("Location: /website/users/login.php");
    exit();
}

// Recuperar informações da conta
$user_id = $_SESSION['user_id'];
$query = "SELECT name, email, DATE_FORMAT(created_at, '%d/%m/%Y') as created_at FROM user WHERE id = ?";
$stmt = $conn->prepare($query);
$stmt->bind_param("i", $user_id);
$stmt->execute();
$result = $stmt->get_result();
$user = $result->fetch_assoc();

// Contar quantidade de posts
$query = "SELECT COUNT(*) AS post_count FROM post WHERE user_id = ?";
$stmt = $conn->prepare($query);
$stmt->bind_param("i", $user_id);
$stmt->execute();
$result = $stmt->get_result();
$post_count = $result->fetch_assoc()['post_count'];

// Contar quantidade de comentários
$query = "SELECT COUNT(*) AS comment_count FROM comment WHERE user_id = ?";
$stmt = $conn->prepare($query);
$stmt->bind_param("i", $user_id);
$stmt->execute();
$result = $stmt->get_result();
$comment_count = $result->fetch_assoc()['comment_count'];

// Fechar a conexão com o banco de dados
$conn->close();
?>
<body>
    <div class="account-container">
        <h1 class="account-welcome">Bem-vindo, <?= htmlspecialchars($user['name']); ?>!</h1>
        <h2>Informações da conta:</h2>
        <br>
        <p class="account-info">Email: <?= htmlspecialchars($user['email']); ?></p>
        <p class="account-info">Data de Criação da Conta: <?= htmlspecialchars($user['created_at']); ?></p>
        <p class="account-info">Quantidade de Posts: <?= htmlspecialchars($post_count); ?></p>
        <p class="account-info">Quantidade de Comentários: <?= htmlspecialchars($comment_count); ?></p>
        <br>
        <form id="deleteAccountForm" method="post" action="delete_account.php">
            <button type="button" class="delete-account-btn" onclick="confirmDeleteAccount()">Encerrar Conta</button>
        </form>
    </div>
    <script>
        function confirmDeleteAccount() {
            if (confirm("Tem certeza de que deseja encerrar sua conta? Todos os seus dados, posts e comentários serão excluídos permanentemente.")) {
                document.getElementById('deleteAccountForm').submit();
            }
        }
    </script>
</body>
<?php require_once('../includes/footer.php'); ?>
