## em construção

php artisan l5-swagger:generate


# Blog API

Este é um projeto de API criado utilizando o framework Laravel 11.
A API fornece endpoints para gerenciar usuários, categorias, posts e comentários.

## Requisitos

- PHP >= 8.1
- Composer
- MySQL ou outro banco de dados compatível

## Instalação

1. Clone o repositório para o seu ambiente local:

   ```bash
   git clone git@github.com:carolinealtoss/blog_api.git

   ```bash
   cd blog_api

2. Instale as dependências do Composer:

    ```bash
    composer install

3. Crie um arquivo .env com base no .env.example:

    ```bash
    cp .env.example .env

4. Configure as variáveis de ambiente no .env, incluindo as informações de conexão ao banco de dados.

5. Gere a chave da aplicação:

    ```bash
    php artisan key:generate

6. Execute as migrações e seeders para preparar o banco de dados:

    ```bash
    php artisan migrate --seed

7. Inicie o servidor de desenvolvimento:

    ```bash
    php artisan serve

## Endpoints da API

A API possui os seguintes endpoints:

### Usuários (/api/user)

- GET /api/user: Lista todos os usuários.
- GET /api/user/{id}: Exibe um usuário específico.
- POST /api/user: Cria um novo usuário.
- PUT /api/user/{id}: Atualiza um usuário existente.
- DELETE /api/user/{id}: Remove um usuário.

### Categorias (/api/category)

- GET /api/category: Lista todas as categorias.
- GET /api/category/{id}: Exibe uma categoria específica.
- POST /api/category: Cria uma nova categoria.
- PUT /api/category/{id}: Atualiza uma categoria existente.
- DELETE /api/category/{id}: Remove uma categoria.

### Posts (/api/post)

- GET /api/post: Lista todos os posts.
- GET /api/post/{id}: Exibe um post específico.
- POST /api/post: Cria um novo post.
- PUT /api/post/{id}: Atualiza um post existente.
- DELETE /api/post/{id}: Remove um post.

### Comentários (/api/comment)

- GET /api/comment: Lista todos os comentários.
- GET /api/comment/{id}: Exibe um comentário específico.
- POST /api/comment: Cria um novo comentário.
- PUT /api/comment/{id}: Atualiza um comentário existente.
- DELETE /api/comment/{id}: Remove um comentário.

Documentação da API
A documentação completa da API foi gerada utilizando o Swagger. Você pode acessá-la através da interface Swagger UI no seu navegador.

Acessando a Documentação
Após iniciar o servidor de desenvolvimento, a documentação estará disponível na seguinte URL:
