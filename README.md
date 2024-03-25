# Teste Desenvolvedor Backend Grupo Bamaq

**PHP:** v8.1.2

**Laravel:** v10.10

**Implementações:** Solid, DDD, TDD, Autenticação JWT

## Installation

Instale a aplicação com os comandos abaixo:

```bash
  composer install
  make up
  make seed -> para criar o usuario adm, para logar
```

## Running Tests

Para executar testes, execute o seguinte comando:

```bash
  make test
```

### Documentation

Link do postman: https://bityl.co/OxGi

#### Headers

```:
  Accept: application/json
  Content-Type: application/json
```

#### Autenticar / Logar

```http
  POST /api/auth
```

| Parameter  | Type      | Description          |
| :--------- | :-------- | :------------------- |
| `email`    | `string`  | **Required**         |
| `password` | `string ` | **Required** (min 6) |

#### Criar usuário

```http
  POST /api/user
```

| Parameter  | Type      | Description          |
| :--------- | :-------- | :------------------- |
| `name`     | `string`  | **Required**         |
| `email`    | `string`  | **Required**         |
| `cpf`      | `string ` | **Required**         |
| `password` | `string ` | **Required** (min 6) |

#### Atualizar usuário

```http
  PUT /api/user
```

| Parameter  | Type      | Description          |
| :--------- | :-------- | :------------------- |
| `name`     | `string`  | **Optional**         |
| `email`    | `string`  | **Optional**         |
| `cpf`      | `string ` | **Optional**         |
| `password` | `string ` | **Optional** (min 6) |

#### Deletar usuário

```http
  DELETE /api/user
```

#### Consultar um usuário

```http
  GET /api/user/${user_id}
```
