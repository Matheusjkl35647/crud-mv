********************** CRUD MORAES VELLEDA ************************
- 01/09/2023 
- Feito Por: Matheus j. Santos 
- CRUD MV: FullStack
- +55 (11) 97231-7718

Versões utilizadas nos Projetos:
Vue/cli - 5.0.8
composer -  2.6.1
Laravel - 10.21.0

Versões utilizadas na máquina:
PHP - 8.2.10
MySQL - 8.1.0
Node.js - 18.17.1
*******************************************************************



******************** INSTALANDO O PROJETO *************************

    Abaixo, organizei um passo a passo de como rodar o meu projeto.

    BACK-END: -> -> -> -> -> PASTA -> -> -> -> -> -> backend-mv
    Pressupondo que o PHP, o LARAVEL e o MYSQL já estão corretamente
    instalados, siga os passos abaixo: 
    
    *OBS: configure a rota para o banco de dados no .env do projeto.

    1º - Abra o terminal CMD;
    2º - Vá até a pasta onde está o projeto, com o comando
         "cd C:/o-caminho-do-projeto" e aperte enter;
    3º - Após o caminho se alternar para o local do projeto, basta
         escrevar "php artisan migrate" e
         apertar enter novamente, assim, você criou as tabelas no
	 Banco de dados;
    4º - Após concluído, no mesmo CMD digite
         "php artisan db:seed --class=UsuarioSeeder", para alimentar
	 o primeiro usuário e pessoa do banco de dados e ter acesso
	 ao sistema.
    5º - Para rodar a aplicação do lado do servidor, no mesmo CMD,
	 digite, "php artisan serve", irá gerar um link igual a
         esse "http://127.0.0.1:8000" e só, você já está pronto
	 pra partir para o Front-end da aplicação. 


    FRONT-END: -> -> -> -> -> PASTA -> -> -> -> -> -> frontend-mv
    Pressupondo que o Node.js (para rodar o comando 'npm') já está
    instalado em sua máquina, siga os seguintes passos: 

    1º - Abra o terminal CMD;
    2º - Vá até a pasta onde está o projeto, com o comando
         "cd C:/o-caminho-do-projeto" e aperte enter;
    3º - Após o caminho se alternar para o local do projeto, basta
         escrevar "npm run dev" e apertar enter novamente;
    4º - Vai gerar um link, muito similar a esse:
         "http://localhost:3000";
    5º - basta copiar esse link e abrir em seu navegador.

******************************************************************



********************** CRUD MORAES VELLEDA ************************
- 01/09/2023 
- Feito Por: Matheus j. Santos 
- CRUD MV: FullStack
- +55 (11) 97231-7718

Versões utilizadas nos Projetos:
Vue/cli - 5.0.8
composer -  2.6.1
Laravel - 10.21.0

Versões utilizadas na máquina:
PHP - 8.2.10
MySQL - 8.1.0
Node.js - 18.17.1
*******************************************************************
