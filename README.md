
# Laravel 9.x - Quick Start (Laravel 9.x + Docker)

- PHP 8.1+
- Laravel 9.0+
- MySQL
- Docker
- PHPUnit e Mockery
- Composer
- PSR4
- TDD
- SOLID
- Clean Architecture

## Executar o Laravel

Entrar na pasta
```sh
cd laravel/
```

Remova qualquer tipo de arquivo referente a versionamento (opcional)
```sh
rm -rf .git/
```

Crie o arquivo .env baseado no de exemplo .env.example
```sh
cp .env.example .env
```

Suba os containers do projeto
```sh
docker-compose up -d
```

Acessar o container *app*
```sh
docker-compose exec app bash
```

Instalar as dependências do projeto
```sh
composer install
```

Gerar a *key* do projeto Laravel
```sh
php artisan key:generate
```

Executar os testes
```sh
./vendor/bin/phpunit 
```
ou
```sh
php artisan test
```
ou
```sh
php artisan test --stop-on-failure
```

Depois basta acessar o projeto em:
[http://localhost:8000](http://localhost:8000)
