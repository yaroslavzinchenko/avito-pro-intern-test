# Тестовое задание стажера в юнит AvitoPRO

PHP сервис представляет собой JSON API для генерации случайных значений, работающий по HTTP. Каждой генерации присваивается уникальный id, по которому можно получить результат генерации методом retrieve.

Реализовны методы
* POST /api/generate/ - генерация случайного значения и его идентификатора
* GET /api/retrieve/ - получение значения по id, которое вернулось в методе generate

При генерировании значений для метода /api/generate/ есть возможность задать входные параметры:
- type - тип возвращаемого случайного значения (string, number, guid, alphanumeric, custom)
- длина возвращаемого значения (length)

Зайдя на сайт, выводится сообщение:

Welcome to the avito-pro-intern-test application!

Для взаимодействия с API я использую приложение Postman.
Выставляю параметры для генерирования:
* Метод: POST
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
* URI: /api/retrieve/?id=273

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

При запросе одного и того же requestId несколькими запросами возвращается то же самое число (возможность идемпотентных запросов).
