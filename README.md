
## Instruções

Após o git clone, deverá executar os seguintes passos:

- Acesse o diretório do porjeto
- Execute 'composer install'
- Copie o arquivo .env.example para .env
- Acesse o arquivo .env e adicione suas credenciais de banco de dados modificando:
  - DB_CONNECTION=mysql
  - DB_HOST=127.0.0.1
  - DB_PORT=3306
  - DB_DATABASE=laravel
  - DB_USERNAME=root
  - DB_PASSWORD=
- Ainda no arquivo .env adicione suas credenciais de configuração de SMTP para o serviço de e-mail modificando:
  - MAIL_DRIVER=smtp
  - MAIL_HOST=smtp.mailtrap.io
  - MAIL_PORT=2525
  - MAIL_USERNAME=null
  - MAIL_PASSWORD=null
  - MAIL_ENCRYPTION=null
  - MAIL_FROM_ADDRESS=null
  - MAIL_FROM_NAME="${APP_NAME}"
- Ainda no arquivo .env, foi criada uma nova variável que irá conter o e-mail padrão para receber as informações de cada contato adicionado. Altere-o para adicionar o e-mail desejado:
  - MAIL_TO_NEW_CONTACT=null
- Saia do arquivo e no terminal execute o comando 'php artisan key:generate'
- Por fim execute o comando 'php artisan migrate' para criar as tabelas no banco de dados

Para acessar, caso não esteja em um servidor ou ambiente preparado, basta executar o comando 'php artisan serve' e acessar o endereço http://localhost:8000

## Testes

Para executar os testes automatizados, no terminal, execute o comando 'vendor/bin/phpunit'
