$(document).ready(function() {
    
    // Mostrar caixa de comentário ao clicar no botão de comentar
    $('.comment-button').click(function(e) {
        e.preventDefault();
        $(this).closest('.post').find('.comment-box').show();
    });

    // Enviar comentário ao clicar no botão de enviar
    $('.comment-send').click(function() {
        var commentBox = $(this).closest('.comment-box');
        var comment = commentBox.find('.comment-text').val().trim();
        var post_id = $(this).closest('.post').data('post-id');

        // Verificar se o comentário não está vazio
        if (comment === '') {
            customAlert('Por favor, insira um comentário válido.');
            return;
        }

        // Enviar comentário para o servidor via AJAX
        $.ajax({
            url: 'insert_comment.php',
            type: 'POST',
            data: {
                post_id: post_id,
                comment: comment
            },
            success: function(response) {
                console.log(response);

                commentBox.find('.comment-text').val('');
                commentBox.hide();

                var successMessage = commentBox.closest('.post').find('.success-message');
                successMessage.show();
                setTimeout(function() {
                    successMessage.hide();
                }, 1500);

                var commentCountElem = commentBox.closest('.post').find('.comment-count');
                var commentCount = parseInt(commentCountElem.text());
                commentCountElem.text(commentCount + 1);
            },
            error: function(xhr, status, error) {
                console.error('Erro ao enviar comentário:', error);
            }
        });
    });

    // Modal de denúncia
    var modal = $('#reportModal');
    var span = $('.close');

    $('.report-button').click(function(e) {
        e.preventDefault();
        var postId = $(this).closest('.post').data('post-id');
        $('#reportPostId').val(postId);
        modal.show();
    });

    span.click(function() {
        modal.hide();
    });

    $(window).click(function(event) {
        if ($(event.target).is(modal)) {
            modal.hide();
        }
    });

    // Enviar denúncia ao servidor via AJAX
    $('#reportForm').submit(function(e) {
        e.preventDefault();
        var post_id = $('#reportPostId').val();
        var reason = $('#reportReason').val();

        $.ajax({
            url: 'report_post.php',
            type: 'POST',
            data: {
                post_id: post_id,
                reason: reason
            },
            success: function(response) {
                console.log(response);
                modal.hide();
                alert('Denúncia enviada com sucesso!');
            },
            error: function(xhr, status, error) {
                console.error('Erro ao enviar denúncia:', error);
            }
        });
    });

    function loadPosts(){
        $('#postagens').hide(); // Esconde os posts enquanto carrega

        $.ajax({
            url: 'load_post.php',
            method: 'GET',
            success: function(data){
                $('#postagens').html(data); // Atualiza o conteúdo das postagens
                $('#postagens').show(); // Mostra os posts
            },
            error: function() {
                customAlert('Erro ao carregar as postagens.');
            }
        });
    }

    loadPosts();

    $('#upload_button').click(function() {
        $('#post_images').click();
    });

    $('#newpost__form').submit(function(event) {
        event.preventDefault();

        var postText = $('#text_post').val().trim();

        if (postText === '') {
            customAlert('Por favor, insira um texto válido.');
            return;
        }

        var formData = new FormData(this);

        if ($('#post_images')[0].files.length > 3) {
            customAlert('Você só pode enviar no máximo 3 imagens.');
            return;
        }

        $.ajax({
            url: 'send_post.php',
            method: 'POST',
            data: formData,
            contentType: false,
            processData: false,
            success: function() {
                loadPosts(); // Carrega novamente as postagens
                $('#text_post').val(''); // Limpa o campo de texto da postagem
                $('#post_images').val(''); // Limpa o campo de upload de imagens
                $('#image_preview').html(''); // Limpa a pré-visualização
            },
            error: function() {
                customAlert('Erro ao enviar a postagem.');
            }
        });
    });

    $('#post_images').change(function() {
        var files = this.files;
        $('#image_preview').html(''); // Limpa as pré-visualizações anteriores

        if (files.length > 3) {
            customAlert('Você só pode enviar no máximo 3 imagens.');
            $('#post_images').val('');
            return;
        }

        for (var i = 0; i < files.length; i++) {
            var file = files[i];
            var reader = new FileReader();
            reader.onload = function(e) {
                var img = $('<img>').attr('src', e.target.result);
                var div = $('<div>').addClass('image-preview__item').append(img);
                var removeButton = $('<button>').text('X').click(function() {
                    $(this).parent().remove();
                });
                div.append(removeButton);
                $('#image_preview').append(div);
            }
            reader.readAsDataURL(file);
        }
    });

    function customAlert(message) {
        var notification = document.createElement('div');
        notification.classList.add('custom-alert');
        notification.textContent = message;

        notification.style.position = 'fixed';
        notification.style.top = '20px';
        notification.style.left = '50%';
        notification.style.transform = 'translateX(-50%)';
        notification.style.backgroundColor = 'rgba(0, 0, 0, 0.8)';
        notification.style.color = 'white';
        notification.style.padding = '10px 20px';
        notification.style.borderRadius = '5px';
        notification.style.zIndex = '9999';

        document.body.appendChild(notification);

        setTimeout(function() {
            document.body.removeChild(notification);
        }, 3000); 
    }

    document.addEventListener("DOMContentLoaded", function() {
        var modal = document.getElementById("rulesModal");
        var span = document.getElementsByClassName("close")[0];

        // Verifica se o modal já foi exibido
        if (!localStorage.getItem("rulesModalDisplayed")) {
            modal.style.display = "block";
            localStorage.setItem("rulesModalDisplayed", "true");
        }

        span.onclick = function() {
            modal.style.display = "none";
        }

        window.onclick = function(event) {
            if (event.target == modal) {
                modal.style.display = "none";
            }
        }
    });

});
