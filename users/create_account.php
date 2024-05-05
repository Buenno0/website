<!DOCTYPE html>
<html lang="pt-br">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Login</title>
  <link rel="stylesheet" href="../style/style.css">
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700&display=swap">
  
</head>
<body>
<div class="container">
  <div class="body-login">
    <div class="card-login">
      <h3>Criar sua conta</h3>
      <form id="signupForm" action="user.php" method="post">
        <div class="form-group">
          <label for="name">Nome de Usuario:</label>
          <input type="text" id="name" name="name" required oninput="validarNome()">
            <span id="nameError" style="color: red;"></span>
        </div>

        <div class="form-group">
          <label for="email">Email:</label>
          <input type="email" placeholder="joao@example.com" id="email" name="email" required>
          <span id="emailError" style="color: red;"></span>
        </div>
        <div class="form-group">
          <label for="password">Senha:</label>
          <input type="password" id="password" name="password" required oninput="validarSenha()">
          <span id="passwordError" style="color: red;"></span>
        </div>
        <button type="submit" class="btn-login">Criar conta</button>
        <p class="p-no-account">Já tem uma conta?</p>
        <a href="login.php" class="no-account">Entre agora</a>
      </form>
    </div>
  </div>
</div>

<div id="statusCard" class="status-card">
  <p id="statusMessage" class="status-message"></p>
</div>
</body>
</html>
<script src="js/validate_user.js"></script>
<script>
  document.getElementById("signupForm").addEventListener("submit", function (event) {
    var isPasswordValid = validarSenha();
    var isNameValid = validarNome();

    if (!isPasswordValid || !isNameValid) {
      event.preventDefault(); // Impede o envio do formulário se a senha ou o nome não forem válidos
      return; // Para a execução da função
    }

    event.preventDefault(); // Evita que o formulário seja enviado normalmente

    var formData = new FormData(this);

    fetch('user.php', {
      method: 'POST',
      body: formData
    })
      .then(response => response.json())
      .then(data => {
        var statusCard = document.getElementById("statusCard");
        var statusMessage = document.getElementById("statusMessage");

        statusMessage.classList.remove("success"); // Remove existing classes
        statusMessage.classList.remove("error");

        statusMessage.textContent = data.message;
        statusMessage.classList.add(data.success ? "success" : "error");

        statusCard.style.display = "block";

        setTimeout(function() {
          statusCard.style.display = "none";
          if (data.success) {
            window.location.href = "index.php"; // Redireciona após 3 segundos
          }
        }, 3000);
      })
      .catch(error => console.error('Error:', error));
  });
</script>

