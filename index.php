<?php
require 'includes/header.php';
?>
<head>
    <style>
        .nav-links {
            margin-right: 20px;
            color: rgba(75, 85, 99, 1);
            text-decoration: none;
            display: flex;
            align-items: center;
        }

        .nav-button {
            display: flex;
            align-items: center;
        }

        #nav-link {
            color: rgba(16, 185, 129, 1);
        }

        #nav-button {
            background-color: var(--primary);
            color: #ffffff;
            padding: 10px 20px;
            border: none;
            border-radius: 32px;
            cursor: pointer;
            display: flex;
            align-items: center;
            margin-right: 7%;
        }

        #nav-button:hover {
            background-color: var(--white);
            color: var(--primary);
        }

        #nav-button .material-symbols-outlined {
            margin-left: 5px;
        }

        /*Contents*/
        /*content-primeiro*/
        .content-primeiro {
            background-color: rgba(15, 184, 128, 0.084);
            padding: 2%;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .hero {
            margin-left: 5%;
        }

        .button,
        .content {
            display: flex;
        }

        .content-primeiro h1 {
            font-size: 64px;
            color: rgba(17, 24, 39, 1);
            letter-spacing: 5px;
        }

        .content-primeiro strong {
            color: rgba(16, 185, 129, 1);
        }

        .content-primeiro p {
            font-size: 16px;
            color: rgba(107, 114, 128, 1);
            margin-top: 30px;
            margin-bottom: 56px;
        }

       /*content-segundo*/
 .content-segundo h3{
    font-weight: normal;
    color: rgba(16, 185, 129, 1);
    position: relative;
    border-bottom: solid 1px rgba(16, 185, 129, 1);   
}
.content-segundo strong{
    color: rgba(16, 185, 129, 1);
}
.content-segundo .conteudo{

    display: flex;
    flex-direction: column;
    align-items: center;
    padding: 2%;
    width: 400px;
    
}

.conteudos .conteudo {
  display: flex;
  flex-direction: column;
  align-items: center;
  padding: 2%;
  width: 400px;
  text-align: center; /* Adiciona centralização do texto */
}

.conteudos .conteudo img {
  margin-top: 10px; /* Espaçamento entre o nome e a imagem */
}

.conteudos .conteudo h2{
    margin: 0;
    padding: 0; 
    margin-top: 2%;
    margin-bottom: 10px;
    text-align: center;
}
.conteudos .conteudo p{
    color: rgba(107, 114, 128, 1);
    font-size: 16px;
    line-height: 1.2em; /* Ajuste este valor para cerca de 3 vezes o tamanho da fonte */
    max-height: 3.6em; /* 3 vezes o tamanho da fonte */
    overflow: hidden;
    margin-top: 5%;
    overflow: hidden;
    text-align: center;
 }
.conteudos .conteudo .link-p{
    text-decoration: none;
    color: rgba(16, 185, 129, 1);
    text-transform: uppercase;
    margin-top: 2%;
    display: block; 
}
.content-segundo .conteudos{
    display: flex;
    justify-content:space-between;
}
.conteudos .conteudo .links-none{
    text-decoration: none; /* Remove o sublinhado */
    color: inherit; /* Mantém a cor do texto padrão */
    display: block; /* Faz o link ocupar a largura total do pai */
    
}

.h2-orixa{
    color: var(--primary);
    font-size: 24px;
    margin: 0;	
    padding: 0;
    text-align: center;

}

.content-segundo{
    padding:0%;
    padding-left: 5%;
    display: flex;
    flex-direction: column;
    align-items: center;
    margin: 5% 5% 5% 5%;
}
        /*content-terceiro*/
        .content-terceiro #button {
            background-color: rgba(245, 255, 255, 1);
            color: rgba(16, 185, 129, 1);
            padding: 10px 20px;
            border: none;
            border-radius: 32px;
            cursor: pointer;
            border: 1px solid rgba(245, 255, 255, 1);
            display: flex;
            align-items: center;
            margin-left: 3%;
            margin-top: 2%;
        }

        .content-terceiro #button:hover {
           background-color: var(--white);
           color: var(--primary);
        }

        .content-terceiro h3 {
            font-size: 48px;
            color: rgba(255, 255, 255, 1);
            margin: 0;
            padding: 0;
            text-align: center;
        }

        .content-terceiro p {
            margin-top: 2%;
            font-size: 16px;
            color: rgba(255, 255, 255, 1);
            padding: 0;
            text-align: center;
        }

        
        /* content-terceiro */
.content-terceiro {
    position: relative;
    width: 100%;
    overflow: hidden;
}

.carousel {
    display: flex;
    transition: transform 0.5s ease-in-out;
}

.carousel-item {
    min-width: 100%;
    box-sizing: border-box;
    padding: 5%;
    background: rgba(16, 185, 129, 0.8);
    display: flex;
    flex-direction: column;
    align-items: center;
}

.carousel-item h3 {
    font-size: 48px;
    color: rgba(255, 255, 255, 1);
    margin: 0;
    padding: 0;
    text-align: center;
}

.carousel-item p {
    margin-top: 2%;
    font-size: 16px;
    color: rgba(255, 255, 255, 1);
    padding: 0;
    text-align: center;
    margin-bottom: 5%;
}

.carousel-item #button {
    background-color: rgba(245, 255, 255, 1);
    color: rgba(16, 185, 129, 1);
    padding: 10px 20px;
    border: none;
    border-radius: 32px;
    cursor: pointer;
    border: 1px solid rgba(245, 255, 255, 1);
    display: flex;
    align-items: center;
    margin-left: 3%;
    margin-top: 2%;
}


        /*content-quarto*/
        .content-quarto .faq h5 {
            display: inline-block;
            color: rgba(16, 185, 129, 1);
            border-bottom: solid 1px rgba(16, 185, 129, 1);
            margin: 0;
        }

        .content-quarto .faq h3 {
            font-size: 48px;
            color: rgba(17, 24, 39, 1);
            margin: 1%;
        }

        .content-quarto .faq strong {
            color: rgba(16, 185, 129, 1);
        }

        .content-quarto .questionario .pergunta h4 {
            background-color: rgba(209, 250, 229, 1);
            padding: 16px;
            border-radius: 8px;
            font-size: 20px;
            color: rgba(16, 185, 129, 1);
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .content-quarto .questionario .pergunta a {
            text-decoration: none;
            color: inherit;
        }

        .content-quarto .questionario .pergunta p {
            font-size: 16px;
            color: rgba(75, 85, 99, 1);
            text-align: justify;
            margin: 5%;
            max-height: 0;
            overflow: hidden;
            transition: max-height 0.5s ease;
        }

        .content-quarto .questionario .pergunta.expanded p {
            max-height: 200px; /* Ajuste conforme necessário */
        }

        .content-quarto .faq {
            padding: 5%;
            display: flex;
            flex-direction: column;
            align-items: start;
        }

        .content-quarto {

    display: flex;
    justify-content: space-between;
    position: relative;
}
.carousel-control-prev, .carousel-control-next {
    position: absolute;
    top: 50%;
    transform: translateY(-50%);
    background-color: rgba(0,0,0,0.5);
    color: white;
    border: none;
    padding: 10px;
    cursor: pointer;
    border-radius: 50%;
    z-index: 100;
}

.img--orixa{
    width: 12vh;
    height: 12vh;
    border-radius: 50%;
    border: solid 1px var(--primary);
}

.carousel-control-prev {
    left: 10px;
}

.carousel-control-next {
    right: 10px;
}

.carousel-dots {
    text-align: center;
    position: absolute;
    bottom: 15px;
    width: 100%;
}

.carousel-dot {
    display: inline-block;
    width: 10px;
    height: 10px;
    margin: 0 5px;
    background-color: rgba(255, 255, 255, 0.5);
    border-radius: 50%;
    cursor: pointer;
}

.carousel-dot.active {
    background-color: rgba(16, 185, 129, 1);
}

.image-carousel {
            position: relative;
            width: 100%;
            overflow: hidden;
            height: 60vh; /* Tamanho padrão para telas maiores */
            border-radius: 5px;

        }

        .image-carousel .carousel-images {
            display: flex;
            transition: transform 0.5s ease-in-out;
        }

        .image-carousel .carousel-image {
            min-width: 100%;
            box-sizing: border-box;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .image-carousel .carousel-image img {
            width: 100%;
            height: auto;
            border-radius: 10px; 
        }


.duvida_img {
    width: 60vh; /* Tamanho padrão para telas maiores */
    height: auto; /* Mantém a proporção */
    flex-shrink: 0; /* Impede que a imagem encolha */
    border-radius: 5px; /* Cantos arredondados */

    /* Media query para telas menores */
    @media screen and (max-width: 768px) {
        width: 80vw; /* Reduz para 80% da largura da viewport */
    }

    /* Media query para telas muito pequenas */
    @media screen and (max-width: 480px) {
        width: 90vw; /* Reduz ainda mais para 90% da largura da viewport */
    }
}


/* Estilos para a barra de rolagem */
.faq {
    padding: 5%;
    display: flex;
    margin-top: 10%;
    flex-direction: column;
    align-items: start;
    width: 100%;
    overflow-y: auto; /* Permite rolagem vertical */
    max-height: 500px; /* Ajuste conforme necessário */
    scrollbar-width: thin; /* Para navegadores que suportam */
    scrollbar-color: rgba(16, 185, 129, 1) rgba(209, 250, 229, 1); /* Cor do scroll */
}

/* Estilos para a barra de rolagem em navegadores WebKit (Chrome, Safari) */
.faq::-webkit-scrollbar {
    width: 10px; /* Largura da barra de rolagem */
}

.faq::-webkit-scrollbar-track {
    background: rgba(209, 250, 229, 1); /* Cor do track da barra de rolagem */
    border-radius: 10px; /* Borda arredondada */
}

.faq::-webkit-scrollbar-thumb {
    background-color: rgba(16, 185, 129, 1); /* Cor do thumb da barra de rolagem */
    border-radius: 10px; /* Borda arredondada */
    border: 2px solid rgba(209, 250, 229, 1); /* Adiciona uma borda ao thumb */
}




        /* Estilos para telas com largura de 600px ou menos */
        @media (max-width: 600px) {

            .content-primeiro {
                flex-direction: column;
            }

            .content-segundo .conteudos {
                flex-direction: column;
            }

            .content-quarto {
                flex-direction: column;
            }

        }
    </style>
</head>
    <div class="contents">
        <div class="content-primeiro">
            <div class="hero">
                <div class="text">
                    <h1 id="text-content">Conheça a <br><strong>Umbanda</strong></h1>
                    <p>Diversidade espiritual e aunião entre os mundos</p>
                </div>
                
                <div class="button">
                    <button id="nav-button">Saiba Mais <span class="material-symbols-outlined">arrow_forward</span></button>
                    <button id="nav-button">Responder <span class="material-symbols-outlined">arrow_forward</span></button>
                </div>
                
            </div>
            <div class="hero-img">
                <img src="Icons/Hero Image.png" alt="img_principal">
            </div>          
        </div>
        <div class="image-carousel">
    <button class="carousel-control-prev">&#10094;</button>
    <div class="carousel-images">
        <div class="carousel-image">
            <img src="assets/umbanda.png" alt="Imagem 1">
        </div>
        <div class="carousel-image">
            <img src="assets/umbanda2.png" alt="Imagem 2">
        </div>
        <div class="carousel-image">
            <img src="assets/umbanda.png" alt="Imagem 3">
        </div>
    </div>
    <button class="carousel-control-next">&#10095;</button>
    <div class="carousel-dots">
        <span class="carousel-dot" data-index="0"></span>
        <span class="carousel-dot" data-index="1"></span>
        <span class="carousel-dot" data-index="2"></span>
    </div>
</div>

        <div class="content-segundo">
            <img src="assets/idea.svg" alt="ideia" class="img--idea">
            
            <h3>Conheça os <strong>Orixás</strong></h3>
          
            <div class="conteudos">
                <a href="" class="links-none">
                    <div class="conteudo" >
                        <h2 class="h2-orixa">Oxala</h2>
                        <img src="assets/oxala.png" alt="oxossi" class="img--orixa">
                        <p>O grande criador, que traz paz e harmonia.</p>

                    </div>
                </a>
                <a href="" class="links-none">    
                    <div class="conteudo">
                        <h2 class="h2-orixa">Yemanjá</h2>
                        <img src="assets/iemanja.png" alt="oxossi" class="img--orixa">
                        <p>"Rainha do mar, mãe das águas da vida.</p>
                    </div>
                </a>
                <a href="" class="links-none">    
                    <div class="conteudo">
                        <h2 class="h2-orixa">Ogum</h2>
                        <img src="assets/ogum.png" alt="oxossi" class="img--orixa">
                        <p>Guerreiro forte, protetor e abridor de caminhos.</p>
                    </div>
                </a>
            </div>
            <div class="conteudos">
                <a href="orixas.html" class="links-none">
                    <div class="conteudo" >
                        <h2 class="h2-orixa">Oxóssi</h2>
                        <img src="assets/oxossi.webp" alt="oxossi" class="img--orixa">
                        <p>Senhor das matas, caçador, provedor e reconhecido.</p>
                    </div>
                </a>
                <a href="" class="links-none">    
                    <div class="conteudo">
                        <h2 class="h2-orixa">Xangô</h2>
                        <img src="assets/xango.png" alt="oxossi" class="img--orixa">
                        <p>Rei da justiça, poderoso e sempre implacável.</p>
                    </div>
                </a>
                <a href="" class="links-none">    
                    <div class="conteudo">
                        <h2 class="h2-orixa">Iansã</h2>
                        <img src="assets/iansa.png" alt="oxossi" class="img--orixa">
                        <p>Deusa dos ventos, tempestades e das almas.</p>
                    </div>
                </a>
            </div>  
            <div class="conteudos">
                <a href="orixas.html" class="links-none">
                    <div class="conteudo" >
                        <h2 class="h2-orixa">Oxum</h2>
                        <img src="assets/oxum.png" alt="oxossi" class="img--orixa">
                        <p>Deusa do amor, beleza e águas doces.</p>
                    </div>
                </a>
                <a href="" class="links-none">    
                    <div class="conteudo">
                        <h2 class="h2-orixa">Obaluaiê</h2>
                        <img src="assets/obaluae.png" alt="oxossi" class="img--orixa">
                        <p>Senhor da cura, doenças e guardião das almas.</p>
                    </div>
                </a>
                <a href="" class="links-none">    
                    <div class="conteudo">
                        <h2 class="h2-orixa">Nanã</h2>
                        <img src="assets/nana.png" alt="oxossi" class="img--orixa">
                        <p>Anciã da sabedoria e da morte, senhora dos pântanos.</p>
                    </div>
                </a>
            </div>    
        </div>
        
        <div class="content-terceiro">
    <div class="carousel">
        <div class="carousel-item">
            <h3>Seu olhar sobre a <br>Umbanda</h3>
            <p>Compartilhe sua Experiência e Conhecimento para Enriquecer Nossa Comunidade Espiritual</p>
            <a href=""><button id="button">responda<span class="material-symbols-outlined">arrow_forward</span></button></a>
        </div>
        <div class="carousel-item">
            <h3>Descubra mais sobre <br>a Umbanda</h3>
            <p>Explore a diversidade espiritual e a união entre os mundos</p>
            <a href=""><button id="button">descubra<span class="material-symbols-outlined">arrow_forward</span></button></a>
        </div>
        <div class="carousel-item">
            <h3>Participe da <br>nossa comunidade</h3>
            <p>Junte-se a nós e compartilhe suas experiências e conhecimentos</p>
            <a href="src/blog.php"><button id="button">participe<span class="material-symbols-outlined">arrow_forward</span></button></a>
        </div>

    </div>
</div>
        <div class="content-quarto">
            <img class="duvida_img" src="Icons/duvida.png" alt="">
            <div class="faq">
                <h5><span>FAQ</span></h5>
                <h3>Perguntas <br><strong>Frequentes</strong></h3>
                <div class="questionario">
                <div class="pergunta">
    <h4>1. O que é um Orixá? <a href="#"><span class="material-symbols-outlined">arrow_drop_down</span></a></h4>
    <p>Orixás são entidades divinas na Umbanda que representam forças da natureza e aspectos da vida humana. Eles são intermediários entre o ser humano e o Ser Supremo, conhecido como Olorum ou Zambi, e cada Orixá possui características, símbolos e responsabilidades específicas, guiando e protegendo seus devotos.</p>
</div>  
<div class="pergunta">
    <h4>2. Quantos Orixás existem na Umbanda? <a href="#"><span class="material-symbols-outlined">arrow_drop_down</span></a></h4>
    <p>Embora o número de Orixás possa variar conforme a tradição e o terreiro, na Umbanda é comum reconhecer um grupo principal de sete Orixás: Oxalá, Ogum, Oxóssi, Xangô, Iansã, Iemanjá e Obaluaê/Omolu. Cada um deles está associado a diferentes aspectos da vida e da natureza.</p>
</div>  
<div class="pergunta">
    <h4>3. Qual é a diferença entre um Orixá e um Guia Espiritual? <a href="#"><span class="material-symbols-outlined">arrow_drop_down</span></a></h4>
    <p>Os Orixás são entidades divinas, enquanto os Guias Espirituais são espíritos de pessoas que viveram na Terra e evoluíram espiritualmente, passando a atuar como protetores e conselheiros dos médiuns e frequentadores dos terreiros. Guias comuns incluem Caboclos, Pretos-Velhos e Crianças (Erês).</p>
</div>  
<div class="pergunta">
    <h4>4. Como são cultuados os Orixás na Umbanda? <a href="#"><span class="material-symbols-outlined">arrow_drop_down</span></a></h4>
    <p>Os Orixás são cultuados através de rituais que incluem cânticos, danças, oferendas e orações. Esses rituais ocorrem nos terreiros de Umbanda, onde os médiuns incorporam os Guias Espirituais e, ocasionalmente, os próprios Orixás, para transmitir mensagens e bênçãos aos presentes.</p>
</div>  
<div class="pergunta">
    <h4>5. Qual a importância das oferendas aos Orixás? <a href="#"><span class="material-symbols-outlined">arrow_drop_down</span></a></h4>
    <p>As oferendas são formas de agradecimento e pedidos de ajuda aos Orixás. Elas geralmente incluem alimentos, flores, bebidas e objetos específicos que agradam a cada Orixá. As oferendas são feitas em locais determinados, como matas, rios, cachoeiras, e no próprio terreiro.</p>
</div>  
                </div>
            </div>
        </div>
    </div>
<?php
require 'includes/footer.php';
?>
<script>
$(document).ready(function(){
    let currentImageIndex = 0;
    const imageItems = $('.carousel-image');
    const imageItemCount = imageItems.length;

    function updateCarousel() {
        $('.carousel-images').css('transform', 'translateX(' + (-currentImageIndex * 100) + '%)');
        $('.carousel-dot').removeClass('active');
        $('.carousel-dot[data-index="' + currentImageIndex + '"]').addClass('active');
    }

    function showNextImage() {
        currentImageIndex = (currentImageIndex + 1) % imageItemCount;
        updateCarousel();
    }

    function showPrevImage() {
        currentImageIndex = (currentImageIndex - 1 + imageItemCount) % imageItemCount;
        updateCarousel();
    }

    let imageSlideInterval = setInterval(showNextImage, 2500); // Change slide every 2.5 seconds

    $('.image-carousel').hover(
        function() {
            clearInterval(imageSlideInterval);
        },
        function() {
            imageSlideInterval = setInterval(showNextImage, 2500);
        }
    );

    $('.carousel-control-next').click(function() {
        clearInterval(imageSlideInterval);
        showNextImage();
        imageSlideInterval = setInterval(showNextImage, 2500);
    });

    $('.carousel-control-prev').click(function() {
        clearInterval(imageSlideInterval);
        showPrevImage();
        imageSlideInterval = setInterval(showNextImage, 2500);
    });

    $('.carousel-dot').click(function() {
        clearInterval(imageSlideInterval);
        currentImageIndex = $(this).data('index');
        updateCarousel();
        imageSlideInterval = setInterval(showNextImage, 2500);
    });

    updateCarousel(); // Set the initial active dot

    let currentIndex = 0;
    const items = $('.carousel-item');
    const itemCount = items.length;

    function showNextItem() {
        currentIndex = (currentIndex + 1) % itemCount;
        $('.carousel').css('transform', 'translateX(' + (-currentIndex * 100) + '%)');
    }

    let slideInterval = setInterval(showNextItem, 2500); // Change slide every 2.5 seconds

    $('.content-terceiro').hover(
        function() {
            clearInterval(slideInterval);
        },
        function() {
            slideInterval = setInterval(showNextItem, 2500);
        }
    );

    $(".pergunta h4 a").click(function(event) {
        event.preventDefault();
        var $this = $(this);
        var $pergunta = $this.closest('.pergunta');

        // Toggle the expanded class
        $pergunta.toggleClass('expanded');

        // Toggle the arrow icon
        var $icon = $this.find('.material-symbols-outlined');
        $icon.text($icon.text() === "arrow_drop_up" ? "arrow_drop_down" : "arrow_drop_up");
    });

    updateCarousel(); // Initialize the carousel
});

</script>
