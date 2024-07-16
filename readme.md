# Diálogo Inter-Religioso

Bem-vindo ao projeto Diálogo Inter-Religioso! Este site foi criado com o objetivo de fomentar o entendimento mútuo e a harmonia entre pessoas de diferentes tradições religiosas.

## Funcionalidades do Site

- **Home:** Página inicial com informações sobre o projeto e sua missão.
- **Questionário:** Um questionário interativo para os usuários responderem.
- **Login:** Funcionalidade de login para acesso a recursos adicionais.
- **Blog:** Usuários logados podem:
  - Postar artigos.
  - Comentar em postagens.
  - Denunciar conteúdos inadequados.
  - Postar fotos.

## Tecnologias Utilizadas

**Frontend:**
- HTML
- CSS
- JavaScript (com jQuery)

**Backend:**
- PHP (utilizando a biblioteca Carbon)

**Banco de Dados:**
- MySQL

**Responsividade:**
- Design adaptável para dispositivos móveis

## Estrutura do Projeto

- `index.php`: Página inicial do site.
- `login.php`: Página de login.
- `register.php`: Página de registro de novos usuários.
- `blog.php`: Página principal do blog.
- `post.php`: Página para criar novas postagens.
- `comment.php`: Página para comentar em postagens.
- `report.php`: Página para denunciar conteúdos.
- `upload.php`: Página para upload de fotos.

## Instalação

1. Clone este repositório:

- git clone https://github.com/seu-usuario/seu-repositorio.git


2. Configure o banco de dados MySQL:

- Crie um banco de dados e importe o arquivo db_site.sql.
- Configure o arquivo de conexão com o banco de dados (config.php):

```php
<?php
$conn = mysqli_connect("localhost", "root", "", "db_site");
if (!$conn) {
  die("Connection failed: " . mysqli_connect_error());
} 
?>

## Capturas de Tela
Home: 
Questionário: 
Blog: 
Postagem: 
Comentário: 
Denúncia: 
Upload de Foto: ![Upload de Foto](Upload de Foto)
Contribuição
Se você deseja contribuir com o projeto, por favor, siga as diretrizes de contribuição e envie um pull request.

Licença
Este projeto está licenciado sob a licença MIT. Veja o arquivo LICENSE para mais detalhes.