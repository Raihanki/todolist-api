# Todolist API

## Instalation

clone this project

rename .env.example to .env

```bash
  cp .env.example .env
```

install all dependencies that needed

```bash
  composer install
```

generate application key

```bash
  php artisan key:generate
```

update database information

-   open .env file change this following code to your database information. By default it will connect to sqlite

```env
  DB_CONNECTION=sqlite
```

run migration

```bash
  php artisan migrate
```

run server

```bash
  php artisan serve
```

for documentation there is postman collection in root folder
