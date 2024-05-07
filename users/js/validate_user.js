function validarNome() {
  var nameInput = document.getElementById("name");
  var nameError = document.getElementById("nameError");
  var name = nameInput.value.trim();

  if (name.length < 3 || name.length > 15) {
      nameError.textContent = "O nome de usuario deve ter entre 3 e 15 caracteres.";
      return false;
  } 
  else if (!/^[a-zA-Z0-9._]+$/.test(name)) {
      nameError.textContent = "O nome de usuario deve conter apenas letras, números, ponto (.) ou sublinhado (_).";
      return false;
  } 
  else if (!/[a-zA-Z]/.test(name)) {
      nameError.textContent = "O nome de usuario deve conter pelo menos uma letra.";
      return false;
  } 
  else {
      nameError.textContent = "";
      nameInput.value = name; 
      return true;
  }
}

function validarSenha() {
    var passwordInput = document.getElementById("password");
    var passwordError = document.getElementById("passwordError");
    var password = passwordInput.value.trim(); // Remove espaços em branco do início e do fim

    if (password.length === 0) {
      passwordError.textContent = "A senha não pode estar em branco.";
      return false; // Retorna false se a senha estiver em branco
    } else if (password.length < 8) {
      passwordError.textContent = "A senha deve ter pelo menos 8 caracteres.";
      return false; // Retorna false se a senha não atender aos critérios
    } else {
      passwordError.textContent = "";
      passwordInput.value = password; // Atualiza o valor do campo de entrada com a senha limpa
      return true; // Retorna true se a senha atender aos critérios
    }
  }

 

 
  