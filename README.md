# task-management-api

За тестване на приложението използвам Postman.
Данните за вход трябва да бъдат подавани като JSON масив [{},{}]

        ТАГОВЕ
Създаване на таг/тагове - > http://localhost/task-management-api/tags  метод POST
[{
    "name": "Tag name 1",
    "color": "color 1"
},
{
    "name": "Tag name 2",
    "color": "color 2"
}
]

Четене на един таг - http://localhost/task-management-api/tags/1 метод GET , 1 e id на тага, за който търсим информация

Четене на всички тагове - http://localhost/task-management-api/tags  метод GET

Промяна на таг/тагове - http://localhost/task-management-api/tags/ метод PUT
Формат на данните - пример:
[{
    "id":1,
    "name": "Зеленчуци",
    "color": "зелен"
},
{
    "id":6,
    "name": "Сезонни плодове",
    "color": "розов"
}]

Изтриване на тагове - http://localhost/task-management-api/tags/ метод DELETE
Формат на данните - пример:
[{
    "id":8
},{
    "id":9
}]


   ЗАДАЧИ

Създаване на задача/задачи: http://localhost/task-management-api/tasks метод POST
Формат на данните:
{    
    "tasks":
    [
        {   "name":"Купи малини", 
            "tags": [
                "Сезонни плодове",
                "Хранителни продукти"
            ]
        }, {   "name":"Купи захар", 
            "tags": [
                "Хранителни продукти"
            ]
        }

    ]
}
Могат да бъдат зададени повече от 1 от съществуващите тагове към 1 задача

Четене на всички задачи: http://localhost/task-management-api/tasks метод GET

Четене на задача по зададено id: http://localhost/task-management-api/tasks/1 метод GET

Промяна на съществуващи задачи/задача по id: http://localhost/task-management-api/tasks метод PUT
Формат на данните:
{    
    "tasks":
    [
        {   "id":2,
             "name":"Купи брашно", 
            "tags": [
                "Хранителни продукти"
            ]
        }
    ]
}


Изтриване на задача/задачи по id: http://localhost/task-management-api/tasks метод DELETE
Формат наданните:
[{
    "id":40
},{
    "id":39
},{
    "id":38
}]
