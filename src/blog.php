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
    --error: red;
}

.post__author {
    font-family: 'Poppins', sans-serif;
}

.p-post {
    margin: 0;
    font-size: 1.2rem;
    font-family: 'Segoe UI', Arial, sans-serif;
    line-height: 1.5;
    color: #333;
}

.blog {
    display: flex;
    flex-direction: row;
    align-items: flex-start;
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
    flex-direction: column;
    align-items: center;
    font-size: 16px;
    font-family: 'Poppins', sans-serif;
    min-height: 100vh;
    width: 60%;
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
    margin-bottom: 1rem;
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


.comment-box {
    display: flex;
    flex-direction: column;
    align-items: flex-end;
}

.comment-box textarea.comment-text {
    border: 1px solid var(--gray-borders);
    padding: 0.5rem;
    border-radius: 0.50rem;
    height: 2.4rem;
    transition: height 0.3s ease-in-out;
    resize: none;
    width: 100%;
    font-size: 1rem;
    font-family: 'Poppins', sans-serif;
}

.comment-box textarea.comment-text:focus {
    outline: none;
    height: 5rem;
    border: 1px solid var(--primary);
}

.comment-box button.comment-send {
    margin-top: 10px;
    padding: 10px 15px;
    border: none;
    border-radius: 1rem;
    background-color: var(--text-green);
    color: white;
    font-size: 14px;
    font-weight: bold;
    cursor: pointer;
    transition: background-color 0.3s;
    align-self: flex-end;
}

.comment-box button.comment-send:hover {
    background-color: var(--primary);
}

.success-message {
   background-color: var(--text-green);
   opacity: 0.8;
    color: white;
    padding: 0.5rem;
    border-radius: 0.5rem;
    margin-top: 10px;
    display: none;
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
.button--primary:hover {
    background-color: var(--primary);
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
    width: 100%;
}


.post__actions {
    display: flex;
    justify-content: space-between;
    align-items: center;
}

.report {
    display: flex;
    justify-content: flex-end;
    align-items: center;
}

img.comment__icon {
    width: 1.5rem;
    height: 1.8rem;
    object-fit: cover;
    cursor: pointer;
   
}

img.comment__icon:hover {
    opacity: 0.5;
}

img.report__icon {
    width: 1.5rem;
    height: 1.5rem;
    object-fit: cover;
    opacity: 0.4;
    cursor: pointer;
    margin-top: 80%;
    
}

img.report__icon:hover {
    opacity: 1;
}

.comment-button {
    display: flex;
    align-items: center;
    gap: 0.25rem; /* Espaço entre o ícone e o contador */
}

.comment-count {
    font-size: 0.9rem;
    font-family: Arial, Helvetica, sans-serif;
    color: var(--gray-dark);
}
/* Estilos para o modal */
.modal {
    display: none;
    position: fixed;
    z-index: 1000;
    left: 0;
    top: 0;
    width: 100%;
    height: 100%;
    overflow: auto;
    background-color: rgba(0, 0, 0, 0.4);
}

.modal-content {
    background-color: var(--background); /* Usando a cor de fundo do site */
    margin: 5% auto;
    padding: 20px;
    border: 1px solid var(--gray-borders); 
    width: 80%;
    border-radius: 0.6rem;
}

.close {
    color: var(--gray-dark); /* Cor de texto semelhante ao restante do site */
    float: right;
    font-size: 28px;
    font-weight: bold;
}
.h2-report {
    color: var(--error);
}   

.close:hover,
.close:focus {
    color: black; /* Cor de texto ao passar o mouse semelhante ao restante do site */
    text-decoration: none;
    cursor: pointer;
}

/* Estilos para o botão do modal */
.modal-button {
    background-color: var(--error); 
    color: var(--white); 
    padding: 10px 20px;
    border: none;
    border-radius: 1rem;
    cursor: pointer;
    transition: background-color 0.3s ease;
}

.modal-button:hover {
    background-color: var(--gray-dark);
    color: var(--error);
     
}
select {
    width: 30%;
    padding: 0.5rem;
    border: none;
    border-radius: 1rem;
    background-color: #f2f2f2;
    font-family: Arial, sans-serif;
    font-size: 16px;
    color: #333;
}

select:focus {
    outline: none;
    box-shadow: 0 0 5px rgba(81, 203, 238, 1);
}

.report-text {
    background-color: lightgray;
    border-radius: 1rem;
    padding: 0.5rem;
    margin-top: 2%;
}



/* Responsividade */
@media only screen and (max-width: 768px) {
    .blog {
        flex-direction: column;
        align-items: center;
    }

    .aside {
        margin: 0;
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
