<!DOCTYPE html>
<html lang="pt">
<head>
    <meta charset="UTF-8">
    <title>Formulário de Contato</title>
</head>
<body>
    <h2>Entre em Contato</h2>
    <form action="sendmail.php" method="post">
        <label for="name">Nome:</label><br>
        <input type="text" id="name" name="name" required><br>

        <label for="email">E-mail:</label><br>
        <input type="email" id="email" name="email" required><br>

        <label for="message">Mensagem:</label><br>
        <textarea id="message" name="message" rows="4" required></textarea><br>

        <input type="submit" value="Enviar">
    </form>
</body>
</html>
