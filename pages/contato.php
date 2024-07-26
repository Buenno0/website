<?php
require_once('../includes/header.php'); 
?>
<head>
    <style>
        .contact-container {
            max-width: 800px;
            margin: 50px auto;
            padding: 20px;
            background: white;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        .developer-profile {
            display: flex;
            align-items: center;
            margin: 40px 0;
            padding-bottom: 20px;
            border-bottom: 1px solid #ddd;
        }

        .developer-profile img {
            border-radius: 50%;
            width: 100px;
            height: 100px;
            object-fit: cover;
            margin-right: 20px;
        }
        .h1-conato{
            color: var(--primary);
        }   

        .developer-details {
            display: flex;
            flex-direction: column;
            justify-content: center;
        }

        .developer-profile h2 {
            margin: 0 0 10px;
            color: var(--primary);
        }

        .developer-profile p {
            margin: 5px 0;
        }

        .developer-profile a {
            color: var(--primary);
            text-decoration: none;
        }

        .developer-profile a:hover {
            text-decoration: underline;
        }

        .footer-note {
            text-align: center;
            margin-top: 30px;
            font-size: 14px;
            color: #777;
        }
    </style>
</head>
<body>
    <div class="contact-container">
        <h1 class="h1-conato">Contato</h1>
        <p>Para saber mais ou tirar dúvidas sobre esse projeto, entre em contato conosco: </p>
        <div class="developer-profile">
            <img src="../assets/gabriel.png" alt="Gabriel Leme">
            <div class="developer-details">
                <h2>Gabriel Leme</h2>
                <p>Email: leme.pereira@aluno.ifsp.edu.br</p>
                <p>GitHub: <a href="https://github.com/gabriel0101010101" target="_blank">github.com/gabriel0101010101</a></p>
            </div>
        </div>
        <div class="developer-profile">
            <img src="../assets/bueno.png" alt="Mateus Bueno">
            <div class="developer-details">
                <h2>Mateus Bueno</h2>
                <p>Email: bueno.mateus@aluno.ifsp.edu.br</p>
                <p>GitHub: <a href="https://github.com/buenno0" target="_blank">github.com/buenno0</a></p>
            </div>
        </div>
        <div class="footer-note">
            <p>Este site foi desenvolvido por Gabriel Leme e Mateus Bueno.</p>
        </div>
    </div>

<?php
require_once('../includes/footer.php'); 
?>
</body>
</html>
