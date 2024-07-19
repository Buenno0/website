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
<body>
    <h1>Dashboard do Administrador</h1>
    <?php
     require_once('header_adm.php');
     if ($result->num_rows > 0): ?>
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
                <div class="post-images">
                    <?php
                    // Consulta para obter as imagens relacionadas ao post
                    $post_id = $row['post_id'];
                    $sqlImages = "SELECT image_path FROM post_image WHERE post_id = ?";
                    $stmtImages = $conn->prepare($sqlImages);
                    $stmtImages->bind_param('i', $post_id);
                    $stmtImages->execute();
                    $resultImages = $stmtImages->get_result();
                    while ($imageRow = $resultImages->fetch_assoc()): ?>
                        <img src="../src/<?php echo $imageRow['image_path']; ?>" alt="Imagem do Post">
                    <?php endwhile; ?>
                </div>
                <div class="button-container">
                    <button class="delete-post-button delete-post" data-post-id="<?php echo $row['post_id']; ?>">Excluir Postagem</button>
                    <button class="delete-user-button delete-post" data-user-id="<?php echo $row['user_id']; ?>">Deletar Usuário</button>
                </div>
            </div>
        <?php endwhile; ?>
    <?php else: ?>
        <p>Nenhuma denúncia encontrada.</p>
    <?php endif; ?>
    <div id="customImageModal" class="custom-modal">
        <span class="custom-close">&times;</span>
        <img class="custom-modal-content" id="customImg01">
        <div id="customCaption"></div>
    </div>
</body>
<?php require_once('../includes/footer.php'); ?>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
$(document).ready(function() {
    $('.delete-post-button').on('click', function() {
        var postId = $(this).data('post-id');
        var card = $(this).closest('.report-card');

        if (confirm('Você tem certeza que deseja excluir esta postagem?')) {
            $.ajax({
                url: 'delete_post.php',
                type: 'POST',
                data: { post_id: postId },
                success: function(response) {
                    var res = JSON.parse(response);
                    if (res.status === 'success') {
                        card.remove();
                    } else {
                        alert(res.message);
                    }
                }
            });
        }
    })

    $('.delete-user-button').on('click', function() {
        var userId = $(this).data('user-id');
        var card = $(this).closest('.report-card');

        if (confirm('Você tem certeza que deseja deletar este usuário?')) {
            $.ajax({
                url: 'delete_user.php',
                type: 'POST',
                data: { user_id: userId },
                success: function(response) {
                    var res = JSON.parse(response);
                    if (res.status === 'success') {
                        card.remove();
                    } else {
                        alert(res.message);
                    }
                }
            });
        }
    });

    // Modal functionality
    var modal = document.getElementById("customImageModal");
    var modalImg = document.getElementById("customImg01");
    var captionText = document.getElementById("customCaption");

    $('.post-images img').on('click', function() {
        modal.style.display = "block";
        modalImg.src = this.src;
        captionText.innerHTML = this.alt;
    });

    var span = document.getElementsByClassName("custom-close")[0];
    span.onclick = function() {
        modal.style.display = "none";
    }
});
</script>
