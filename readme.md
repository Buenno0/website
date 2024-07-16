Projeto de Diálogo Inter-Religioso
Bem-vindo ao projeto de Diálogo Inter-Religioso! Este site foi criado com o objetivo de combater a intolerância religiosa, promovendo o diálogo e a compreensão entre diferentes crenças.

Funcionalidades do Site
Home: Página inicial com informações sobre o projeto e sua missão.
Questionário: Questionário interativo para os usuários responderem.
Login: Funcionalidade de login para acesso a recursos adicionais.
Blog: Usuários logados podem:
Postar artigos.
Comentar em postagens.
Denunciar conteúdos inadequados.
Postar fotos.
Tecnologias Utilizadas
Frontend:
HTML
CSS
JavaScript (com jQuery)
Backend:
PHP (com a biblioteca Carbon)
Banco de Dados:
MySQL
Responsividade:
Design responsivo para dispositivos móveis
Estrutura do Projeto
index.php: Página inicial do site.
login.php: Página de login.
register.php: Página de registro de novos usuários.
blog.php: Página principal do blog.
post.php: Página para criar novas postagens.
comment.php: Página para comentar em postagens.
report.php: Página para denunciar conteúdos.
upload.php: Página para upload de fotos.
Instalação
Clone este repositório:

bash
Copiar código
git clone https://github.com/seu-usuario/seu-repositorio.git
Navegue até o diretório do projeto:

bash
Copiar código
cd seu-repositorio
Configure o banco de dados MySQL:

Crie um banco de dados e importe o arquivo database.sql.
Configure o arquivo de conexão com o banco de dados (config.php):

php
Copiar código
<?php
$servername = "localhost";
$username = "seu-usuario";
$password = "sua-senha";
$dbname = "seu-banco-de-dados";
?>
Inicie o servidor local:

bash
Copiar código
php -S localhost:8000
Acesse o site em http://localhost:8000.

Capturas de Tela
Home

Questionário

Blog

Postagem

Comentário

Denúncia

Upload de Foto

Contribuição
Se você deseja contribuir com o projeto, por favor, siga as diretrizes de contribuição e envie um pull request.

Licença
Este projeto está licenciado sob a licença MIT. Veja o arquivo LICENSE para mais detalhes.