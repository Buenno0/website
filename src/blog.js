$(document).ready(function(){

    
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

    $('#upload_button').click(function(){
        $('#post_images').click();
    });

    $('#newpost__form').submit(function(event){
        event.preventDefault(); 

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
            success: function(){
                loadPosts(); // Carrega novamente as postagens
                $('#text_post').val(''); // Limpa o campo de texto da postagem
                $('#post_images').val(''); // Limpa o campo de upload de imagens
                $('#image_preview').html(''); // Limpa a pré-visualização
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
    // Crie um elemento de notificação
    var notification = document.createElement('div');
    notification.classList.add('custom-alert');
    notification.textContent = message;

    // Estilize a notificação
    notification.style.position = 'fixed';
    notification.style.top = '20px';
    notification.style.left = '50%';
    notification.style.transform = 'translateX(-50%)';
    notification.style.backgroundColor = 'rgba(0, 0, 0, 0.8)';
    notification.style.color = 'white';
    notification.style.padding = '10px 20px';
    notification.style.borderRadius = '5px';
    notification.style.zIndex = '9999';

    // Adicione a notificação ao corpo do documento
    document.body.appendChild(notification);

    // Remova a notificação após alguns segundos
    setTimeout(function() {
        document.body.removeChild(notification);
    }, 3000); // 3000 milissegundos = 3 segundos
}

// Use customAlert() em vez de alert() em seu código

});