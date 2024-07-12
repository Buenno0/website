<?php
require_once('../includes/header.php');
require_once('../config/config.php');

// Verifica se o usuário está logado e é administrador
if (!isset($_SESSION['user_id']) || $_SESSION['user_type'] !== 'adm') {
    header("Location: ../users/login.php");
    exit();
}

// Consulta para obter as denúncias
$sql = "SELECT 
            reports.id AS report_id,
            reports.reason,
            reports.created_at AS report_created_at,
            post.id AS post_id,
            post.content AS post_content,
            post.created_at AS post_created_at,
            user.id AS user_id,
            user.name AS user_name,
            user.email AS user_email
        FROM 
            reports
        JOIN 
            post ON reports.post_id = post.id
        JOIN 
            user ON post.user_id = user.id";
$result = $conn->query($sql);
?>
<style>
    body {
        font-family: Arial, sans-serif;
    }
    .report-card {
        border: 1px solid #ccc;
        padding: 16px;
        margin-bottom: 16px;
        border-radius: 8px;
    }
    .report-details, .user-info {
        margin-bottom: 12px;
    }
    .button-container {
        margin-top: 12px;
    }
    .delete-button {
        background-color: red;
        color: white;
        border: none;
        padding: 8px 12px;
        border-radius: 4px;
        cursor: pointer;
    }
</style>
<body>
    <h1>Dashboard do Administrador</h1>
    <?php if ($result->num_rows > 0): ?>
        <?php while ($row = $result->fetch_assoc()): ?>
            <div class="report-card">
                <h2>Denúncia #<?php echo $row['report_id']; ?></h2>
                <p><strong>Razão:</strong> <?php echo $row['reason']; ?></p>
                <div class="report-details">
                    <div><strong>Data da Denúncia:</strong> <?php echo $row['report_created_at']; ?></div>
                    <div><strong>ID do Post:</strong> <?php echo $row['post_id']; ?></div>
                    <div><strong>Conteúdo do Post:</strong> <?php echo $row['post_content']; ?></div>
                    <div><strong>Data do Post:</strong> <?php echo $row['post_created_at']; ?></div>
                </div>
                <div class="user-info">
                    <div><strong>ID do Usuário:</strong> <?php echo $row['user_id']; ?></div>
                    <div><strong>Nome do Usuário:</strong> <?php echo $row['user_name']; ?></div>
                    <div><strong>Email do Usuário:</strong> <?php echo $row['user_email']; ?></div>
                </div>
                <div class="button-container">
                    <button class="delete-button" onclick="confirmDeletion('post', <?php echo $row['post_id']; ?>)">Excluir Postagem</button>
                    <button class="delete-button" onclick="confirmDeletion('user', <?php echo $row['user_id']; ?>)">Deletar Usuário</button>
                </div>
            </div>
        <?php endwhile; ?>
    <?php else: ?>
        <p>Nenhuma denúncia encontrada.</p>
    <?php endif; ?>
</body>
<script>
    function confirmDeletion(type, id) {
        let message = type === 'post' ? 'Tem certeza que deseja excluir esta postagem?' : 'Tem certeza que deseja deletar este usuário?';
        if (confirm(message)) {
            window.location.href = `delete.php?type=${type}&id=${id}`;
        }
    }
</script>
