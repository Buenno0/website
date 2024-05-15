<?php require_once('../includes/header.php'); ?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Comments</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins&display=swap" rel="stylesheet" type="text/css">
    <link rel="stylesheet" href="style.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <style>
   :root {
      --background: white;
      --white: white;
      --gray-light: #FAFBFC;
      --gray-borders: #ECF1F4;
      --gray-dark: #AEB7C2;
     
  }
  .post__author {
      font-family: 'Poppins', sans-serif;
    }
    /* CSS reset */
   
    .p-post {
    margin: 0;
    font-size: 1.2rem; /* Tamanho da fonte ajustado para rem */
    font-family: 'Segoe UI', Arial, sans-serif; /* Fonte alternativa */
    line-height: 1.5; /* Espaçamento entre linhas para melhor legibilidade */
    color: #333; /* Cor do texto ajustada */
    /* Adicione outros estilos conforme necessário */
}
 
    .blog {
        display: flex;
        flex-direction: row; /* Para que os elementos fiquem lado a lado */
        align-items: flex-start; /* Alinha os itens ao topo */
        font-size: 16px;
        font-family: 'Poppins', sans-serif;
        margin-top: 2%;
        width: 100%;
        background-color: var(--background);
        word-break: break-word;
    }
    
    .aside {
        flex: 1;
        background-color: var(--text-green);
        padding: 1.5rem;
        border-radius: 1rem;
        margin: 1.5rem;
        border: 1px solid #e0e0e0;
        box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.1);
        width: 20%;
    }

    .aside h2 {
        font-size: 1.5rem;
        margin-bottom: 1rem;
        color: white;
    }

    .aside ul {
        list-style-type: none;
        padding: 0;
        margin: 0;
    }

    .aside ul li {
        margin-bottom: 0.5rem;
    }

    .aside ul li a {
        color: white;
        text-decoration: none;
        font-size: 1.1rem;
        transition: color 0.3s ease;
    }

    .aside ul li a:hover {
        color: #007bff;
    }
    
    .discussion {
        display: flex;
        flex-direction: column; /* Alterado para column para os posts ficarem abaixo do textarea */
        align-items: center; /* Centraliza os elementos horizontalmente */
        font-size: 16px;
        font-family: 'Poppins', sans-serif;
        min-height: 100vh;
        width: 60%; /* A div do meio ocupará 60% da largura total */
        background-color: var(--background);
    }
    
    .discussion__header {
        border-bottom: var(--gray-borders);
        display: flex;
        gap: 0.5rem;
        border-radius: 0.5rem 0.5rem 0 0;
        overflow: hidden;
        padding: 1rem;
        width: 100%;
        margin-bottom: 1rem; /* Adicionado margem inferior para separar os posts */
    }
    .avatar {
      border-radius: 50%;
      width: 2.5rem;
      height: 2.5rem;
      object-fit: cover;
  }
    
    .discussion__header textarea {
        border: 1px solid var(--gray-borders);
        padding: 0.5rem;
        border-radius: 0.25rem;
        height: 3rem;
        transition: height 0.3s ease-in-out;
        resize: none;
        width: 100%;
        font-size: 1.2rem;
        font-family: 'Poppins', sans-serif;
        
    }
    
    .discussion__header textarea:focus {
        outline: none;
        height: 5rem;
        border: 1px solid var(--primary);
    }
    
    .post {
        display: flex;
        padding: 1rem;
        min-height: 6rem;
        gap: 0.25rem;
        border-bottom: solid 1px var(--gray-borders);
    }
    
    .newpost__toolbar {
        justify-content: end;
        display: flex;
        gap: 0.5rem;
        padding: 0.25rem;
    }
    
    .newpost__toolbar button {
        border: none;
        cursor: pointer;
        padding: 0.7rem;
        border-radius: 1rem;
    }
    
    .button--primary {
        background-color: var(--text-green);
        color: var(--white);
        min-width: 5rem;
    }
    
    .post__text {
        font-size: 0.75rem;
        word-wrap: break-word;
        display: flex;
    }
    
    .post__author {
        font-size: 0.8rem;
        word-wrap: break-word;
    }
    
    .post__date {
        font-size: 0.75rem;
        margin-left: 0.25rem;
        color: var(--gray-dark);
        word-wrap: break-word;
    }
    
    .discussion__posts {
        width: 100%; /* Adicionado para ocupar toda a largura */
    }
    
    .post__actions {
        display: flex;
        width: 120vh;
        justify-content: space-between;
    }
    
    .report {
        display: flex;
        justify-content: flex-end;
        align-items: center;
    }
    
    img.comment__icon {
        width: 1.8rem;
        height: 2.2rem;
        object-fit: cover;
        cursor: pointer;
    }
    
    img.comment__icon:hover {
        opacity: 0.5;
    }
    
    img.report__icon {
        width: 1.8rem;
        height: 1.5rem;
        object-fit: cover;
        opacity: 0.5;
        cursor: pointer;
    }
    
    img.report__icon:hover {
        opacity: 1;
    }

    /* Adicione esta seção ao final do seu arquivo CSS */
    
    @media only screen and (max-width: 768px) {
        .blog {
            flex-direction: column;
            align-items: center;
        }
    
        .aside {
            margin: 0; /* Remove a margem lateral nas versões responsivas */
            width: 100%;
        }
    
        .discussion {
            width: 100%;
        }
        .post__actions {
            display: flex;
            justify-content: space-between;
            align-items: center;
            width: 43vh;
        }
    }
    /* Para tablets */
@media only screen and (min-width: 769px) and (max-width: 1024px) {
    .blog {
        flex-direction: row;
        align-items: flex-start;
    }

    .aside {
        margin: 0 20px;
        width: 50%;
    }

    .discussion {
        width: 50%;
    }

    .post__actions {
        display: flex;
        justify-content: space-between;
        align-items: center;
        width: 80vh;
    }
}

/* Para desktops */
@media only screen and (min-width: 1025px) {
    .blog {
        flex-direction: row;
        align-items: flex-start;
    }

    .aside {
        margin: 0 20px;
        width: 40%;
    }

    .discussion {
        width: 60%;
    }

    .post__actions {
        display: flex;
        justify-content: space-between;
        align-items: center;
        width: 98vh;
    }
}

    </style>
</head>

<div class="blog">
    
<aside class="aside">
    <h2>Artigos Recentes</h2>
    <ul>
        <li><a href="#">10 Práticas Essenciais na Umbanda</a></li>
        <li><a href="#">A Importância dos Orixás na Umbanda</a></li>
        <li><a href="#">Como Preparar uma Firmeza na Umbanda</a></li>
    <hr>
        <li><a href="#">10 Práticas Essenciais na Umbanda</a></li>
        <li><a href="#">A Importância dos Orixás na Umbanda</a></li>
        <li><a href="#">Como Preparar uma Firmeza na Umbanda</a></li>
    </ul>
</aside>
    <div class="discussion">
        <div class="discussion__header">
            <form id="newpost__form">
                <textarea id="text_post" tabindex="1" name="texto" cols="150" rows="4" minlength="5" required placeholder="Escreva sua postagem"></textarea>
                <div class="newpost__toolbar">
                    <button id="confirm-button" class="button--primary" tabindex="2" type="submit">Postar</button>
                </div>
            </form>
        </div>
        <div class="discussion__posts" id="postagens">
            <!-- posts -->
        </div>
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
    <script>
        $(document).ready(function(){
            // Função para carregar as postagens
            function loadPosts(){
                $.ajax({
                    url: 'load_post.php',
                    method: 'GET',
                    success: function(data){
                        $('#postagens').html(data); // Atualiza o conteúdo das postagens
                    }
                });
            }

          
            loadPosts();

       
            $('#newpost__form').submit(function(event){
                event.preventDefault(); 

              
                var dados = $(this).serialize();

                
                $.ajax({
                    url: 'send_post.php',
                    method: 'POST',
                    data: dados,
                    success: function(){
                        // Após o sucesso, carrega novamente as postagens para exibir a nova postagem
                        loadPosts();
                        // Limpa o campo de texto da postagem
                        $('#text_post').val('');
                    }
                });
            });
        });
    </script>
