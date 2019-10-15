# Тестовое задание стажёра в юнит AvitoPRO

### Описание:

PHP сервис представляет собой JSON API для генерации случайных значений, работающий по HTTP. Каждой генерации присваивается уникальный id, по которому можно получить результат генерации методом retrieve.

Реализовны методы
* POST /api/generate/ - генерация случайного значения и его идентификатора
* GET /api/retrieve/ - получение значения по id, которое вернулось в методе generate

### Особенности:
* При генерировании значений для метода /api/generate/ есть возможность задать входные параметры:
    * type - тип возвращаемого случайного значения (string, number, guid, alphanumeric, custom)
    * length - длина возвращаемого значения
* При запросе одного и того же requestId несколькими запросами возвращается то же самое число (возможность идемпотентных запросов).
* Сервис поставляется как Docker образ, опубликованный в публичном репозитории
* Сервер доступен на порту 8001, phpMyAdmin - на порту 8000

### Используемые технологии:
* PHP
* Slim Framework
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
* URI: localhost:8001/api/retrieve/273

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

Если хотим получить все значения из базы данных, то:
* Метод: GET
* URI: localhost:8001/api/retrieve/all/

Ответ:
```
[
    {
        "id": "258",
        "value": "87586",
        "type": "number",
        "length": "5",
        "created_at": "2019-10-14 20:35:16"
    },
    {
        "id": "259",
        "value": "-47510",
        "type": "number",
        "length": "5",
        "created_at": "2019-10-14 20:35:16"
    },
    {
        "id": "260",
        "value": "77498",
        "type": "number",
        "length": "5",
        "created_at": "2019-10-14 20:35:16"
    },
    {
        "id": "261",
        "value": "b4eee1",
        "type": "alphanumeric",
        "length": "3",
        "created_at": "2019-10-14 20:35:16"
    },
    {
        "id": "262",
        "value": "c501ed",
        "type": "alphanumeric",
        "length": "3",
        "created_at": "2019-10-14 20:35:16"
    },
    {
        "id": "263",
        "value": "5c3c0b",
        "type": "alphanumeric",
        "length": "3",
        "created_at": "2019-10-14 20:35:16"
    },
    {
        "id": "264",
        "value": "{2CCF7432-A085-D24F-0B37-D55E91E4564F}",
        "type": "guid",
        "length": "32",
        "created_at": "2019-10-14 20:35:16"
    },
    {
        "id": "265",
        "value": "{DAE6FA06-2E79-5A5B-487A-420B556EEA87}",
        "type": "guid",
        "length": "32",
        "created_at": "2019-10-14 20:35:16"
    },
    {
        "id": "266",
        "value": "{65564046-7942-7746-CB2A-F6CBBFF56763}",
        "type": "guid",
        "length": "32",
        "created_at": "2019-10-14 20:35:16"
    },
    {
        "id": "267",
        "value": "KRTJEwEDEb",
        "type": "string",
        "length": "10",
        "created_at": "2019-10-14 20:35:16"
    },
    {
        "id": "268",
        "value": "eyuYPJgSti",
        "type": "string",
        "length": "10",
        "created_at": "2019-10-14 20:35:16"
    },
    {
        "id": "269",
        "value": "xTBgWhnstL",
        "type": "string",
        "length": "10",
        "created_at": "2019-10-14 20:35:16"
    },
    {
        "id": "270",
        "value": "3ssdss3",
        "type": "custom",
        "length": "7",
        "created_at": "2019-10-14 20:35:16"
    },
    {
        "id": "271",
        "value": "ssJJ<ss",
        "type": "custom",
        "length": "7",
        "created_at": "2019-10-14 20:35:16"
    },
    {
        "id": "272",
        "value": "dJ8899L",
        "type": "custom",
        "length": "7",
        "created_at": "2019-10-14 20:35:16"
    },
    {
        "id": "273",
        "value": "-6622156123",
        "type": "number",
        "length": "10",
        "created_at": "2019-10-14 20:35:16"
    },
    {
        "id": "274",
        "value": "9355701925",
        "type": "number",
        "length": "10",
        "created_at": "2019-10-14 21:19:22"
    },
    {
        "id": "275",
        "value": "-8943776322",
        "type": "number",
        "length": "10",
        "created_at": "2019-10-14 21:20:14"
    },
    {
        "id": "276",
        "value": "-3",
        "type": "number",
        "length": "1",
        "created_at": "2019-10-14 21:20:21"
    },
    {
        "id": "277",
        "value": "9",
        "type": "number",
        "length": "1",
        "created_at": "2019-10-14 21:21:17"
    },
    {
        "id": "278",
        "value": "-5",
        "type": "number",
        "length": "1",
        "created_at": "2019-10-14 21:21:27"
    },
    {
        "id": "279",
        "value": "5",
        "type": "number",
        "length": "1",
        "created_at": "2019-10-14 21:21:39"
    },
    {
        "id": "280",
        "value": "9",
        "type": "number",
        "length": "1",
        "created_at": "2019-10-14 21:24:09"
    },
    {
        "id": "281",
        "value": "-9",
        "type": "number",
        "length": "1",
        "created_at": "2019-10-14 21:24:12"
    },
    {
        "id": "282",
        "value": "4",
        "type": "number",
        "length": "1",
        "created_at": "2019-10-14 21:49:38"
    },
    {
        "id": "283",
        "value": "7",
        "type": "number",
        "length": "1",
        "created_at": "2019-10-14 21:49:40"
    }
]
```

### Ошибки:

Если при заходе на localhost:8001 видим Internal Server Error, то нужно сделать некоторые манипуляции.

Запускаем Docker:
```
docker-compose up -d
```

Подключаемся к нашему контейнеру:
```
docker container exec -it avito-pro-intern-test_www_1 bash
```

Говорим:
```
a2enmod rewrite
```

Затем
```
service apache2 restart
```

Теперь можно опять запустить контейнер:
```
docker-compose up
```