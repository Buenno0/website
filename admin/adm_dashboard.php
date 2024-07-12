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
    .report-span{
        color: var(--error);
    }
    .report-card {
        background-color: #fff;
        border: 1px solid #ccc;
        border-radius: 8px;
        margin-bottom: 20px;
        padding: 10px;
        box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
    }
    .report-card h2 {
        margin-bottom: 15px;
        color: #333;
    }
    .report-card p,
    .report-card .report-details div,
    .report-card .user-info div {
        margin-bottom: 15px;
        color: #666;
    }
    .report-details div,
    .user-info div {
        padding: 5px 0;
    }
    .button-container {
        margin-top: 20px;
    }
    .delete-button {
        background-color: var(--error);
        color: white;
        border: none;
        padding: 10px 15px;
        border-radius: 4px;
        cursor: pointer;
        margin-right: 10px;
    }
    .delete-button:hover {
        background-color: darkred;
    }
    @media (max-width: 768px) {
        .report-card {
            padding: 15px;
        }
        .report-card h2 {
            font-size: 1.2em;
        }
        .report-card p,
        .report-card .report-details div,
        .report-card .user-info div {
            font-size: 0.9em;
        }
        .delete-button {
            padding: 8px 12px;
        }
    }
</style>
<body>
    <h1>Dashboard do Administrador</h1>
    <?php if ($result->num_rows > 0): ?>
        <?php while ($row = $result->fetch_assoc()): ?>
            <div class="report-card">
                <h2>Denúncia <span class="report-span"> #<?php echo $row['report_id']; ?></span></h2>
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
<?php require_once('../includes/footer.php'); ?>
