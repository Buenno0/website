// Função para calcular o tempo desde a criação do post
const timeSince = (date) => {
    const seconds = Math.floor((new Date() - date) / 1000);

    let interval = seconds / 31536000;

    if (interval > 1) {
        return Math.floor(interval) + " years ago";
    }
    interval = seconds / 2592000;
    if (interval > 1) {
        return Math.floor(interval) + " months ago";
    }
    interval = seconds / 86400;
    if (interval > 1) {
        return Math.floor(interval) + " days ago";
    }
    interval = seconds / 3600;
    if (interval > 1) {
        return Math.floor(interval) + " hours ago";
    }
    interval = seconds / 60;
    if (interval > 1) {
        return Math.floor(interval) + " minutes ago";
    }

    if (seconds < 10) {
        return "just now";
    }

    return Math.floor(seconds) + " seconds ago";
}

// Definição dos usuários


// Usuário logado
const loggedUser = users['alex1'];

// Array de posts (será preenchido pelos dados da API PHP)
let posts = [];

// Função para buscar os posts da API PHP
const fetchPostsFromAPI = () => {
    fetch('load_post.php')
        .then(response => {
            if (!response.ok) {
                throw new Error('Erro na rede');
            }
            return response.json();
        })
        .then(data => {
            if (data.length === 0) {
                console.log('Nenhum post encontrado');
            } else {
                posts = data;
                renderPosts();
            }
        })
        .catch(error => console.error('Erro ao buscar os posts:', error));
};


// Função para renderizar os posts na tela
const renderPosts = () => {
    const commentsWrapper = document.querySelector('.discussion__comments');
    commentsWrapper.innerHTML = ''; // Limpa o conteúdo atual

    posts.forEach(post => {
        const postElement = createPost(post);
        commentsWrapper.appendChild(postElement);
    });
};

// Função para criar o HTML de um post
const createPost = (post) => {
    const newDate = new Date(post.createdAt);
    return DOMPurify.sanitize(`<div class="post">
        <div class="avatar">
            <img
                class="avatar"
                src="${post.author.src}"
                alt="${post.author.name}"
            >
        </div>
        <div class="comment__body">
            <div class="comment__author">
                ${post.author.name}
                <time
                    datetime="${post.createdAt}"
                    class="comment__date"
                >
                    ${timeSince(newDate)}
                </time>
            </div>
            <div class="comment__text">
                <p>${post.text}</p>
            </div>
        </div>
    </div>`);
};

// Chamada para buscar os posts quando a página carregar
window.addEventListener('load', fetchPostsFromAPI);
