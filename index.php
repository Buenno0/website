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
        .content-segundo h3 {
            font-weight: normal;
            color: rgba(16, 185, 129, 1);
            position: relative;
            border-bottom: solid 1px rgba(16, 185, 129, 1);
        }

        .content-segundo strong {
            color: rgba(16, 185, 129, 1);
        }

        .content-segundo .conteudo {
            display: flex;
            flex-direction: column;
            align-items: center;
            padding: 2%;
        }

        .conteudos .conteudo h2 {
            margin: 0;
            padding: 0;
            margin-top: 2%;
            margin-bottom: 10px;
            text-align: center;
        }

        .conteudos .conteudo p {
            color: rgba(107, 114, 128, 1);
            font-size: 16px;
            line-height: 1.2em;
            max-height: 3.6em;
            overflow: hidden;
            margin-top: 5%;
            overflow: hidden;
            text-align: center;
        }

        .conteudos .conteudo .link-p {
            text-decoration: none;
            color: rgba(16, 185, 129, 1);
            text-transform: uppercase;
            margin-top: 2%;
            display: block;
        }

        .content-segundo .conteudos {
            display: flex;
            justify-content: space-between;
        }

        .conteudos .conteudo .links-none {
            text-decoration: none;
            color: inherit;
            display: block;
        }

        .content-segundo {
            padding: 0%;
            padding-left: 5%;
            display: flex;
            flex-direction: column;
            align-items: center;
            margin: 5%;
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

        .content-terceiro {
            background: rgba(16, 185, 129, 0.8);
            display: flex;
            align-items: center;
            flex-direction: column;
            padding: 5%;
            padding-left: 5%;
            padding-right: 5%;
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

        <div class="content-segundo">
            <h3><span>SOBRE</span></h3>
            <h1>Tradições da <strong>Umbanda</strong></h1>
            <div class="conteudos">
                <a href="" class="links-none">
                    <div class="conteudo" >
                        <h2>Orixas</h2>
                        <p>Os Orixás são as forças ancestrais que guiam nossos passos, iluminando o caminho da alma na jornada da vida.</p>
                        <a href="" class="link-p">Leia mais</a>
                    </div>
                </a>
                <a href="" class="links-none">    
                    <div class="conteudo">
                        <h2>Orixas</h2>
                        <p>Os Orixás são as forças ancestrais que guiam nossos passos, iluminando o caminho da alma na jornada da vida.</p>
                        <a href="" class="link-p">Leia mais</a>
                    </div>
                </a>
                <a href="" class="links-none">    
                    <div class="conteudo">
                        <h2>Orixas</h2>
                        <p>Os Orixás são as forças ancestrais que guiam nossos passos, iluminando o caminho da alma na jornada da vida.</p>
                        <a href="" class="link-p">Leia mais</a>
                    </div>
                </a>
                <a href="" class="links-none">    
                    <div class="conteudo">
                        <h2>Orixas</h2>
                        <p>Os Orixás são as forças ancestrais que guiam nossos passos, iluminando o caminho da alma na jornada da vida.</p>
                        <a href="" class="link-p">Leia mais</a>
                    </div>
                </a>  
            </div>
        </div>
        
        <div class="content-terceiro">
            <h3>Seu olhar sobre a <br>Umbanda</h3>
            <p>Compartilhe sua Experiência e Conhecimento para Enriquecer Nossa Comunidade Espiritual</p>
            <button id="button">responda<span class="material-symbols-outlined">arrow_forward</span></button>
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
    $(".pergunta h4 a").click(function(event) {
        event.preventDefault();
        var $this = $(this);
        var $pergunta = $this.closest('.pergunta');

        // Toggle the expanded class
        $pergunta.toggleClass('expanded');

        // Toggle the arrow icon
        var $icon = $this.find('.material-symbols-outlined');
        if ($icon.text() === "arrow_drop_up") {
            $icon.text("arrow_drop_down");
        } else {
            $icon.text("arrow_drop_up");
        }
    });
});
</script>
