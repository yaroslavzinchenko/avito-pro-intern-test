# Тестовое задание стажёра в юнит AvitoPRO

### Описание:

PHP сервис представляет собой JSON API для генерации случайных значений, работающий по HTTP. Каждой генерации присваивается уникальный id, по которому можно получить результат генерации методом retrieve.

Реализовны методы
* POST /api/generate/ - генерация случайного значения и его идентификатора
* GET /api/retrieve/ - получение значения по id, которое вернулось в методе generate

### Особенности:
* При запросе одного и того же requestId несколькими запросами возвращается то же самое число (возможность идемпотентных запросов).
* Сервис поставляется как Docker образ, опубликованный в публичном репозитории
* При генерировании значений для метода /api/generate/ есть возможность задать входные параметры:
    * type - тип возвращаемого случайного значения (string, number, guid, alphanumeric, custom)
    * length - длина возвращаемого значения
* Сервер доступен на порту 8001, phpMyAdmin - на порту 8000

### Используемые технологии:
* PHP
* Apache
* MySQL
* phpMyAdmin
* Github
* Docker

### Сборка:
Переходим в директорию, где будем собирать, например
```
cd DIRECTORY_NAME
```

Клонируем

```
git clone https://github.com/yaroslavzinchenko/avito-pro-intern-test.git
```

Идём в директорию avito-pro-intern-test
```
cd avito-pro-intern-test
```

Запускаем
```
docker-compose up
```

После окончания запуска можно зайти в localhost:8000 и войти в phpMyAdmin:
* Пользователь: root
* Пароль: password

Здесь можно увидеть нашу базу данных avito-pro-intern-test, которая автоматически импортировалась при запуске docker-compose up, там как в файле docker-compose.yaml я указал папку, из которой MySQL берёт файл для импортирования базы данных. В эту папку я положил файл avito-pro-intern-test.sql, содержащий информацию о базе данных avito-pro-intern-test, которую я перед этим заполнил сгенерированными значениями каждого типа.


### Взаимодействие:

Зайдя на сайт (localhost:8001), выводится сообщение:

```
Welcome to the avito-pro-intern-test application!
```

Для взаимодействия с API я использую приложение Postman.
Выставляю параметры для генерирования:
* Метод: POST
* URI: localhost:8001/api/generate/
* Headers: Content-Type: application/json
* Body: raw:
```
{
    "type": "number",
    "length": 10
}
```

Ответ:
```
{
    "id": "273",
    "message": "Value Generated"
}
```

Для получения значения по id, которое вернулось в методе generate, выставляем параметры:
* Метод: GET
* URI: localhost:8001/api/retrieve/?id=273

Ответ:
```
{
    "id": "273",
    "value": "-6622156123",
    "type": "number",
    "length": "10",
    "created_at": "2019-09-29 18:16:16"
}
```
