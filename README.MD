# Тестовое задание для Lidofon

Используемые технологии:

- Laravel 11
- PHP 8.2
- MariaDB
- Redis

## Запуск

> sh up.sh

## Выполнение artisan команд

> docker compose run --rm artisan ...

## Примеры публичных запросов

### Регистрация

> POST http://localhost/api/register

> {
"email": "artem@user.com",
"name": "Артем",
"last_name": "Ли",
"middle_name": "Георгиевич",
"phone": "89998887766",
"password": "artem"
> }

### Логин

> POST http://localhost/api/login

> {
"email": "user@user.com",
"password": "user"
> }

### Восстановление пароля

> POST http://localhost/api/reset-password

> {
"email": "user@user.com"
> }

### Установка нового пароля

> POST http://localhost/api/reset-password/token

> {
"email": "user@user.com",
"token": "nn6uMlMtAGKeFK56ZMyabOn5DUfXXNwyQgjRsusl",
"password": "user2",
"password_confirmation": "user2"
> }

## Примеры приватных запросов

Авторизация через bearer token

### Получение юзеров

> http://localhost/api/users

### Получение удаленных юзеров

> http://localhost/api/users/deleted

### Получение юзера по id

> http://localhost/api/user/ID

### Обновление юзера по id

> UPDATE http://localhost/api/user/ID

> {
"email": "user221@user.com",
"name": "Максим",
"last_name": "Ли",
"middle_name": "Георгиевич",
"phone": "12312312312"
> }

### Удаление юзера по id

> DELETE http://localhost/api/user/ID

### Массовое удаление

> DELETE http://localhost/api/users/delete

> {
"ids": [
"9d31fea0-13e9-4fba-851d-1a8966c81ea3",
"9d31fea0-14fb-48e1-b9a2-1d9b86fdce4f"
]
> }

### Массовое восстановление

> POST http://localhost/api/users/restore

> {
"ids": [
"9d31fea0-13e9-4fba-851d-1a8966c81ea3",
"9d31fea0-14fb-48e1-b9a2-1d9b86fdce4f"
]
> }

### Массовое удаление из корзины

> DELETE http://localhost/api/users/force

> {
"ids": [
"9d31fea0-13e9-4fba-851d-1a8966c81ea3",
"9d31fea0-14fb-48e1-b9a2-1d9b86fdce4f"
]
> }

## Доступы к БД

> host: localhost
>
> port: 3306
>
> user: homestead
>
> password: secret
>
> database: homestead