# Agenda de Contatos

Após clonar, caso queira testar localmente:

```dosini
# Instale as dependências
composer install && npm install

# Crie um .ENV e defina as credencias do banco
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=
DB_USERNAME=
DB_PASSWORD=

# Gere a chave
php artisan key:generate

# Execute as migrations
php artisan migrate

# Compile o front
npm run dev

# Suba o server
php artisan serve
```
