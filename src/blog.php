<?php require_once('../includes/header.php'); ?>
<style>
 img.post-image {
    width: 100%;
    max-width: 100%;
    height: auto;
    border-radius: 0.5rem;
    object-fit: contain;
    margin-top: 0.5rem;
    max-height: 31rem;
    cursor: pointer;
    border: 1px solid #ccc;
    box-shadow: 0 0 5px rgba(0, 0, 0, 0.1);
    
}
.image-carousel {
    display: flex;
    overflow-x: auto;
    scroll-snap-type: x mandatory;
    scroll-behavior: smooth;
    gap: 0.5rem;
    margin-top: 0.5rem;
    margin-bottom: 0.5rem;
}

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