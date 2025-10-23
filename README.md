# ApoiaMais

## Sobre o Projeto
ApoiaMais é um projeto desenvolvido em Laravel, um framework PHP robusto e moderno.

## Requisitos do Sistema
- PHP 8.1 ou superior
- Composer
- Node.js e NPM
- SQLite (ou outro banco de dados de sua preferência)

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

4. Configure o ambiente
```bash
# Copie o arquivo de exemplo de ambiente
cp .env.example .env

# Gere a chave da aplicação
php artisan key:generate
```

5. Configure o banco de dados
- O projeto está configurado para usar SQLite por padrão
- Crie um arquivo de banco de dados SQLite:
```bash
touch database/database.sqlite
```

6. Execute as migrações
```bash
php artisan migrate
```

7. Compile os assets
```bash
npm run dev
```

8. Inicie o servidor
```bash
php artisan serve
```

O projeto estará disponível em `http://localhost:8000`

## Estrutura do Projeto

- `/app` - Contém o core da aplicação
- `/config` - Arquivos de configuração
- `/database` - Migrações e seeds do banco de dados
- `/public` - Arquivos públicos
- `/resources` - Views, assets não compilados
- `/routes` - Definições de rotas
- `/storage` - Arquivos gerados pela aplicação
- `/tests` - Testes automatizados

## Desenvolvimento

Para desenvolvimento, você pode usar os seguintes comandos:

- `npm run dev` - Compila assets em modo de desenvolvimento
- `npm run build` - Compila assets para produção
- `php artisan test` - Executa os testes


