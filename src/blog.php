<?php require_once('../includes/header.php'); ?>
<div class="blog">  
<aside class="aside">
    <h2>O que você encontrará aqui:</h2>
    <ul>
        <li><a href="#">Entendendo a Sabedoria Ancestral da Umbanda</a></li>
        <li><a href="#">Mitos e Verdades sobre a Umbanda</a></li>
        <li><a href="#">Depoimentos e Histórias de Vida</a></li>
    </ul>
    <hr>
</aside>


    <div class="discussion">
    <?php if (isset($_SESSION['user_id'])): ?>
    <div class="discussion__header">
        <form id="newpost__form" enctype="multipart/form-data">
            <textarea id="text_post" tabindex="1" name="texto" cols="150" rows="4" required placeholder="No que você está pensando?"></textarea>
            <input type="file" id="post_images" name="images[]" accept="image/*" multiple tabindex="3" style="display: none;">    
            <div id="image_preview" class="image-preview"></div>
            <div class="newpost__toolbar">
                <button type="button" id="upload_button" class="button--upload">
                    <img src="../assets/upload_img.svg" alt="Upload Icon" class="upload-icon">
                    <span class="upload-text">Imagem</span>
                </button>
                <button id="confirm-button" class="button--primary" tabindex="2" type="submit">Postar</button>
            </div>
        </form>
    </div>
<?php else: ?>
    <h2><a href="/website/users/login.php">Entre</a> em sua conta para postar e comentar</h2>
    <br>
<?php endif; ?>
<div class="discussion__posts" id="postagens"></div>
        <div class="discussion__posts" id="postagens"></div>
</div>
<aside class="aside">
    <h2>Regras do Blog</h2>
    <ul>
        <li><a href="">Respeito mútuo: Comentários desrespeitosos ou ofensivos não serão tolerados.</a></li>
        <li><a href="">Foco no tema: Mantenha os comentários e postagens relacionados à Umbanda e temas correlatos.</a></li>
        <li><a href="">Não compartilhe informações pessoais: Preserve sua privacidade e a dos outros usuários.</a></li>
        <li><a href="">Evite spam: Não faça postagens repetitivas ou com conteúdo promocional.</a></li>
        <li><a href="">Seja construtivo: Contribua para o diálogo de forma positiva e com respeito às diversas crenças.</a></li>
    </ul>
</aside>

<div id="rulesModal" class="modal">
    <div class="modal-content-rules">
        <span class="close">&times;</span>
        <h2>Regras da Comunidade</h2>
        <p>Bem-vindo ao nosso espaço de discussão <span style="color: red;">respeitosa</span> e <span style="color: red;">inter-religiosa</span>. Por favor, siga estas regras:</p>
        <ul>
            <li>Postagens contendo <span style="color: red;">intolerância religiosa</span> serão excluídas.</li>
            <li><span style="color: red;">Discursos de ódio</span>, <span style="color: red;">discriminação</span> e <span style="color: red;">insultos</span> não serão tolerados.</li>
            <li><span style="color: red;">Respeite</span> as opiniões e crenças dos outros.</li>
            <li>Promova um ambiente de <span style="color: red;">diálogo construtivo</span> e <span style="color: red;">inclusivo</span>.</li>
        </ul>
    </div>
</div>
</div>
<script>
    document.addEventListener('DOMContentLoaded', () => {
    const form = document.getElementById('newpost__form');
    const textPost = document.getElementById('text_post');
    const confirmButton = document.getElementById('confirm-button');

    form.addEventListener('submit', function(event) {
        if (textPost.value.trim() === '') {
            event.preventDefault();
            alert('Por favor, insira um texto válido.');
        }
    });
});

</script>
<script src="blog.js"></script>
<?php require_once('../includes/footer.php'); ?>
