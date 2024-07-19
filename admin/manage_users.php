<?php
require_once('../includes/header.php');
require_once('../config/config.php');

// Verifica se o usuário está logado e é administrador
if (!isset($_SESSION['user_id']) || $_SESSION['user_type'] !== 'adm') {
    header("Location: ../users/login.php");
    exit();
}

// Consulta para obter todos os usuários com contagens adicionais
$sql = "SELECT 
    u.id,
    u.name AS username,
    u.email,
    u.created_at,
    u.user_type,
    (SELECT COUNT(*) FROM post p WHERE p.user_id = u.id) AS post_count,
    (SELECT COUNT(*) FROM comment c WHERE c.user_id = u.id) AS comment_count,
    (SELECT COUNT(DISTINCT p.id) FROM post p JOIN reports r ON p.id = r.post_id WHERE p.user_id = u.id) AS reported_post_count
FROM 
    user u
ORDER BY
    u.name";

$result = $conn->query($sql);
?>
<body>
    <h1>Gerenciar Usuários</h1>
    <?php require_once('header_adm.php'); ?>
    <table class="user-table">
        <thead>
            <tr>
                <th>Nome de Usuário</th>
                <th>Email</th>
                <th>Data de Criação</th>
                <th>Tipo de Usuário</th>
                <th>Quantidade de Posts</th>
                <th>Quantidade de Comentários</th>
                <th>Quantidade de Posts com Denúncia</th>
                <th>Ações</th>
            </tr>
        </thead>
        <tbody>
            <?php if ($result->num_rows > 0): ?>
                <?php while ($row = $result->fetch_assoc()): ?>
                    <tr data-user-id="<?php echo $row['id']; ?>">
                        <td><?php echo $row['username']; ?></td>
                        <td><?php echo $row['email']; ?></td>
                        <td><?php echo $row['created_at']; ?></td>
                        <td><?php echo $row['user_type']; ?></td>
                        <td><?php echo $row['post_count']; ?></td>
                        <td><?php echo $row['comment_count']; ?></td>
                        <td><?php echo $row['reported_post_count']; ?></td>
                        <td>
                            <?php if ($row['user_type'] === 'comun'): ?>
                                <button class="action-button promote" data-user-id="<?php echo $row['id']; ?>">Tornar Admin</button>
                            <?php else: ?>
                                <button class="action-button demote" data-user-id="<?php echo $row['id']; ?>">Revogar Admin</button>
                            <?php endif; ?>
                        </td>
                    </tr>
                <?php endwhile; ?>
            <?php else: ?>
                <tr>
                    <td colspan="8">Nenhum usuário encontrado.</td>
                </tr>
            <?php endif; ?>
        </tbody>
    </table>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
    $(document).ready(function() {
        $('.promote').on('click', function() {
            var userId = $(this).data('user-id');
            var row = $(this).closest('tr');

            if (confirm('Tem certeza de que deseja promover este usuário a administrador?')) {
                $.ajax({
                    url: 'update_user_type.php',
                    type: 'POST',
                    data: { user_id: userId, action: 'promote' },
                    success: function(response) {
                        var res = JSON.parse(response);
                        if (res.status === 'success') {
                            row.find('td').eq(3).text('admin');
                            row.find('button').removeClass('promote').addClass('demote').text('Revogar Admin');
                        } else {
                            alert(res.message);
                        }
                    }
                });
            }
        });

        $('.demote').on('click', function() {
            var userId = $(this).data('user-id');
            var row = $(this).closest('tr');

            if (confirm('Tem certeza de que deseja revogar o cargo de administrador deste usuário?')) {
                $.ajax({
                    url: 'update_user_type.php',
                    type: 'POST',
                    data: { user_id: userId, action: 'demote' },
                    success: function(response) {
                        var res = JSON.parse(response);
                        if (res.status === 'success') {
                            row.find('td').eq(3).text('comun');
                            row.find('button').removeClass('demote').addClass('promote').text('Tornar Admin');
                        } else {
                            alert(res.message);
                        }
                    }
                });
            }
        });
    });
    </script>
</body>
<?php require_once('../includes/footer.php'); ?>
