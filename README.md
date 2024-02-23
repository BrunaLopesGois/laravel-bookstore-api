# Laravel Bookstore API 📖

![Status](https://badgen.net/badge/api/up/green)

Projeto de uma API Rest, para ser consumida pela aplicação Vue Bookstore (disponível no meu github), simulando uma livraria online.

## Endpoints em produção:

**Listar livros:** GET https://laravel-bookstore-api.fly.dev/api/books

**Livro por ID:** GET https://laravel-bookstore-api.fly.dev/api/books/{id}

**Livro por nome:** GET https://laravel-bookstore-api.fly.dev/api/books?search={termo}

**Incluir livro:** POST https://laravel-bookstore-api.fly.dev/api/books (body params abaixo)

**Atualizar livro:** PUT https://laravel-bookstore-api.fly.dev/api/books/{id} (body params abaixo)

**Excluir livro:** DELETE https://laravel-bookstore-api.fly.dev/api/books/{id}

**Comprar livro:** POST https://laravel-bookstore-api.fly.dev/api/checkout/books/{id} (body params abaixo)

**Login(gerar token):** POST https://laravel-bookstore-api.fly.dev/api/login

**Dados do usuário:** GET https://laravel-bookstore-api.fly.dev/api/user

### Corpos das requisições:

**Incluir/atualizar livro:**

```
{
    "title": "Titulo",
    "cover": "Endereço do arquivo de capa" (opcional),
    "genre": "Genero",
    "description": "Descricao",
    "sale_price": 99.99
}

```

**Comprar livro:**

```
{
    "card_number": "1234123412341234",
    "owner_name": "John Doe",
    "expiration_date": "01/01/2030",
    "cvv": 123
}

```

## Como configurar em ambiente local:

### Pré requisitos

-   PHP v7.4 (ext: php7.4-cli php7.4-json php7.4-common php7.4-mysql php7.4-zip php7.4-gd php7.4-mbstring php7.4-curl php7.4-xml php7.4-bcmath php7.4-sqlite3)
-   Composer

### Passos

-   git clone https://github.com/brunalopesgois/laravel-bookstore-api.git
-   composer install
-   Crie um arquivo .env a partir do .env.example.
-   php artisan key:generate
-   Configure as variáveis de e-mail para usar a função de mensageria.
-   Configure a variável JWT_KEY para ser possível a autenticação.
-   Para iniciar servidor local: php artisan serve
-   Para ativar envio de e-mail: php artisan queue:listen

## Uso

É necessário estar autenticado para acessar as rotas: GET '/users', POST '/books', UPDATE '/books/id', DELETE 'books/id' e GET 'checkout/books/id'.
Para isso, faça uma requisição POST para a rota '/login', com os seguintes parâmetros no corpo:

-   email
-   password

Existem dois níveis de acesso na aplicação, a seguir as credenciais para realizar o login:

### Administrador

email: admin@example.com

password: admin

### Cliente

email: client@example.com

password: client

Exemplo de rota:

'http://localhost:8000/api/books'

## Licença

[MIT license](https://opensource.org/licenses/MIT).
