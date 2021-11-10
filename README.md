# Procedimentos de Instalação e configuração do ambiente
   
Após clonar o repositório, através do terminal, deve-se acessar a pasta `docker` e preparar o arquivo `.env` para a construção do container, dentro da pasta existe um arquivo `.env.example` para servir de guia, lá estão os parametros necessários para a construção da imagem, sendo eles:

- DEEPCENTER_DIR - Caminho do diretório do projeto
- WEB_PORT - Porta que será utilizada para acesso via navegador
- MYSQL_DIR - Caminho para armazenar os arquivos de banco de dados
- MYSQL_PASS - Senha do usuário root
- MYSQL_PORT - Porta de acesso ao banco de dados
- REDIS_DIR - Caminho para armazenar os arquivos do redis
- REDIS_PORT - Porta de acesso ao redis

Por padrão a seguintes range de IP's de container foi atribuida a stack: `172.18.0.0/16`. Se for necessário mudar essa range por motivos de conflito, deve-se editar o arquivo `docker-compose.yml` e alterar os IP's atribuidos para as imagens de MySQL e Redis, pois com a porta e os IP's devidamente configurados, ambos são acessiveis por fora dos containers.   

Uma vez configurado o arquivo `.env`, basta executar os seguintes comandos no terminal para a construção de criação dos containers: `docker-compose build && docker-compose up -d`.

Após a criação do container, alguns procedimetos devem ser executados, como a instalação de dependencias do composer e os pacotes relacionados ao npm.

Acesse o container com o seguinte comando: `docker exec -it app_deepcenter bash`, feito isso você estará dentro do container na pasta `/var/www/html`, acesse a pasta `deepcenter` e execute os seguintes comandos:

- composer install
- php artisan migrate
- npm install
- npm run dev

Feito isso você já deve ter acesso a aplicação completa no navegador em `localhost` com a porta configurada no `.env`

A primeira etapa será se cadastrar através do link `Register` onde será solicitado Nome, E-mail, uma Senha e a confirmação desta senha.
Ao completar o cadastro você estará na área logada, onde em um menu lateral você terá 3 links:
- Home
- Membros
- Logout

# Home
Esta é a tela exibida ao cadastrar-se ou efetuar o login

# Membros
é Um conjunto de telas onde são listado os membros cadastrados, é possível adicionar novos membros, editar e excluir

# Logout
Te desloga da aplicação e te devolve para a tela inicial

Quaisquer dúvidas encontro-me a inteira disposição para saná-las