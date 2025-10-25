# ApoiaMais

## Sobre o Projeto
ApoiaMais é um projeto desenvolvido em Laravel, um framework PHP robusto e moderno.

## Requisitos do Sistema
- PHP 8.1 ou superior
- Composer
- Node.js e NPM
- MySQL 5.7 ou superior

## Instalação

1. Clone o repositório
```bash
git clone https://github.com/marcoskaiky/ApoiaMais.git
cd ApoiaMais
```

2. Instale as dependências do PHP
```bash
composer install
```

3. Instale as dependências do Node.js
```bash
npm install
```

# Gere a chave da aplicação
php artisan key:generate
```

```
- Configure as credenciais do banco de dados no arquivo .env:
  - DB_CONNECTION=mysql
  - DB_HOST=127.0.0.1
  - DB_PORT=3306
  - DB_DATABASE=apoiamais
  - DB_USERNAME=root
  - DB_PASSWORD=sua_senha

6. Execute as migrações e seeders
```bash
php artisan migrate --seed
```

7. Compile os assets
```bash
npm run dev
```

8. Inicie o servidor
```bash
php artisan serve
```

9. Os login de admin e usuario comum se encontra em database/seeders/UserSeeder.php


O projeto estará disponível em `http://localhost:8000`




