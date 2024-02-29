Projeto de API REST feita em PHP 8.3 + Laravel 10 + MySql 8, com as seguintes funcionalidades: 

O ambiente de desenvolvimento foi criado via Docker e está utilizando o Nginx como proxy reverso.

Para utilizar, após o clone do repositório:

Suba o container: docker-compose up -d --build

Em /api, renomeie o .env.example para .env

Acesse o container do php-fpm com: 3.1) docker ps //para ver o id do container 3.2) docker exec -it <ID_DO_CONTAINER> bash

Rode as migrations com as seeds dentro do container, em /api: php artisan migrate --seed

Isso fará com que o banco seja populado com 10 users, address, cities e states.


## Documentação API User & Address

### READ users

``
  GET http://localhost:8083/api/user
``

#### Query Params:

É possível realizar a pesquisa enviando os parâmetros: id, name, age e email. A API retorna dados dos usuários da pesquisa e seus respectivos endereços.
Os parâmetros são opcionais. Se estiverem setados, a API retornará a consulta pesquisada. Caso contrário, a API retornará todos usuários.

#### Responses:

```javascript
1) Exemplo Status 200 - Sucesso
  {
    "message": "Operação realizada com sucesso.",
    "data": [
        {
            "id": 1,
            "name": "Dr. Edward McKenzie",
            "age": 56,
            "email": "sheldon10@example.net",
            "street": "Runolfsson Manor",
            "number": "560",
            "city": "Macejkovicville",
            "state": "California",
            "zip_code": "94271-4922"
        },
        {
            "id": 2,
            "name": "Stacy Beatty",
            "age": 80,
            "email": "vfeil@example.com",
            "street": "Zetta Villages",
            "number": "900",
            "city": "Handchester",
            "state": "Arkansas",
            "zip_code": "10873"
        }
    ]
}

```
#### Tratamento de erros:
```javascript
1) Pesquisar por usuários enviando os parâmetros não esperados:
{
    "id": [
        "ID needs to be integer."
    ],
    "age": [
        "Age field must be an integer"
    ],
    "email": [
        "E-mail field must be a valid string e-mail."
    ]
}
```

### CREATE user

``
  POST http://localhost:8083/api/user
``

#### Request body: x-www-form-urlencoded

| Parâmetro   | Tipo       | Descrição                           |
| :---------- | :--------- | :---------------------------------- |
| `name` | `string` | **Obrigatório**. Nome do usuário |
| `age` | `integer` | **Obrigatório**. Idade do usuário |
| `email` | `string` | **Obrigatório**. E-mail do usuário |

#### Responses:

```javascript
Exemplo Status 201 - Created
  {
    "message": "Operação realizada com sucesso.",
    "data": {
        "name": "Jorge Aragao",
        "age": "29",
        "email": "jorgearagao@gmail.com",
        "updated_at": "2024-02-29T07:42:40.000000Z",
        "created_at": "2024-02-29T07:42:40.000000Z",
        "id": 11
    }
}

```
#### Tratamento de erros:
```javascript
1) Parâmetros inválidos
{
    "age": [
        "Age field must be an integer"
    ],
    "email": [
        "E-mail field must be a valid string e-mail."
    ]
}

```

### UPDATE user

``
  PUT http://localhost:8083/api/user
``

#### Authorization: Bearer [token_de_retorno_da_rota_/login]

#### Request body: x-www-form-urlencoded

| Parâmetro   | Tipo       | Descrição                           |
| :---------- | :--------- | :---------------------------------- |
| `id` | `string` | **Obrigatório**. ID do usuário |
| `name` | `string` | **Opcional**. Nome do usuário |
| `age` | `integer` | **Opcional**. Idade do usuário |
| `email` | `string` | **Opcional**. E-mail do usuário |


#### Responses:

```javascript
1) Exemplo Status 200 - Success
{
    "message": "Operação realizada com sucesso.",
    "data": true
}

```
#### Tratamento de erros:
```javascript
1) Parâmetros inválidos
{
    "id": [
        "ID needs to exist in users table."
    ],
    "age": [
        "Age field must be < 100"
    ],
    "email": [
        "E-mail field must be a valid string e-mail."
    ]
}

```

### DELETE user

``
  DELETE http://localhost:8083/api/user
``

#### Request body: x-www-form-urlencoded

| Parâmetro   | Tipo       | Descrição                           |
| :---------- | :--------- | :---------------------------------- |
| `id` | `string` | **Obrigatório**. ID do usuário |


#### Responses:

```javascript
1) Exemplo Status 200 - Success
 {
    "message": "Operação realizada com sucesso.",
    "data": true
}


```
#### Tratamento de erros:
```javascript
1) User não encontrado
{
    "id": [
        "ID needs to exist in users table."
    ]
}
```

#### Observação
Database name: mentes-notaveis
