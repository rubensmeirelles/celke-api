## Requisitos
* PHP 8.2 ou superior
* MySQL 8 ou superior
* Composer

## Como rodar o projeto


Duplicar o arquivo ".env.example" e renomear para ".env.<br>
Alterar no arquivo .env as credenciais do banco de dados

Instalar as dependências do PHP
```
composer install
```

Gerar a chave
```
php artisan key:generate
```

Executar as migrations
```
php artisan migrate
```

Iniciar o projeto criado com Laravel
```
php artisan serve
```

Para acessar a API é recomendado utilizar o Insomnia para simular requisições à API
```
http://127.0.0.1:8000
```


## Sequência para criar o projeto
Criar o projeto com Laravel
```

composer create-project laravel/laravel .

Alterar no arquivo .env as credenciais do banco de dados.<br>

Criar arquivo de rotas para API
```
php artisan install:api
```
