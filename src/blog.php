<?php require_once('../includes/header.php'); ?>
<style>
   
</style>
<div class="blog">  
<aside class="aside">
    <h2>Artigos Recentes</h2>
    <ul>
        <li><a href="#">10 Práticas Essenciais na Umbanda</a></li>
        <li><a href="#">A Importância dos Orixás na Umbanda</a></li>
        <li><a href="#">Como Preparar uma Firmeza na Umbanda</a></li>
    <hr>
    </ul>
</aside>
    <div class="discussion">
    <?php if (isset($_SESSION['user_id'])): ?>
    <div class="discussion__header">
        <form id="newpost__form" enctype="multipart/form-data">
            <textarea id="text_post" tabindex="1" name="texto" cols="150" rows="4" minlength="5" required placeholder="Escreva sua postagem"></textarea>
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
    <h2>Recursos Recomendados</h2>
    <ul>
        <li><a href="#">Livro: Fundamentos da Umbanda</a></li>
        <li><a href="#">Vídeo: Introdução aos Orixás</a></li>
        <li><a href="#">Notícia: Celebração de Ogum no Terreiro X</a></li>
    </ul>
</aside>
</html>
<script src="blog.js"></script>