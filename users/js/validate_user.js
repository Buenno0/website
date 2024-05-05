function validarNome() {
  var nameInput = document.getElementById("name");
  var nameError = document.getElementById("nameError");
  var name = nameInput.value.trim();

  if (name.length < 3 || name.length > 15) {
      nameError.textContent = "O nome deve ter entre 3 e 15 caracteres.";
      return false;
  } 
  else if (!/^[a-zA-Z0-9._]+$/.test(name)) {
      nameError.textContent = "O nome deve conter apenas letras, números, ponto (.) ou sublinhado (_).";
      return false;
  } 
  else if (!/[a-zA-Z]/.test(name)) {
      nameError.textContent = "O nome deve conter pelo menos uma letra.";
      return false;
  } 
  else {
      nameError.textContent = "";
      nameInput.value = name; 
      return true;
  }
}



 

 
  