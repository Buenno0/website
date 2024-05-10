
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
   
</head>
<body class="blog">
    <div class="discussion">
        <div class="discussion__header">
            <form id="newcomment__form">
                <textarea id="text_post" tabindex="1" name="texto" cols="150" rows="4" minlength="5" required placeholder="Write a comment"></textarea>
                <div class="newcomment__toolbar">
                    <button id="reset-button" class="button--secondary" tabindex="3" type="button">Apagar</button>
                    <button id="confirm-button" class="button--primary" tabindex="2" type="submit">Postar</button>
                </div>
            </form>
        </div>
        <div class="discussion__comments" id="postagens">
            <!-- As postagens serão geradas aqui -->
        </div>
    </div>
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

       
            $('#newcomment__form').submit(function(event){
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
</body>
</html>
