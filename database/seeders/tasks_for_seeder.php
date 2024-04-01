<?php

return [
    [
        'name' => 'Допилить дизайн главной страницы',
        'description' => 'Вёрстка поехала в далёкие края. Нужно удалить бутстрап!',
        'status_id' => 1,
        'created_by_id' => 1,
        'assigned_to_id' => 3,
        'labels' => [
            7, 6, 5
        ]
    ],
    [
        'name' => 'Отрефакторить авторизацию',
        'description' => 'Выпилить всё легаси, которое найдёшь',
        'status_id' => 1,
        'created_by_id' => 1,
        'assigned_to_id' => 2,
        'labels' => [
            5, 7, 2
        ]
    ],
    [
        'name' => 'Исправить поиск',
        'description' => 'Не ищет то, что мне хочется',
        'status_id' => 1,
        'created_by_id' => 1,
        'assigned_to_id' => 6,
        'labels' => [
            2, 7, 9, 12
        ]
    ],
    [
        'name' => 'Вернуть крошки',
        'description' => 'Вернуть крошки как было до настоящей версии',
        'status_id' => 2,
        'created_by_id' => 4,
        'assigned_to_id' => 5,
        'labels' => [
            2, 5
        ]
    ],
    [
        'name' => 'Поправить меню',
        'description' => 'Добавить новый пункт в главное меню',
        'status_id' => 2,
        'created_by_id' => 2,
        'assigned_to_id' => 1,
        'labels' => [
            8, 1
        ]
    ],
    [
        'name' => 'Развернуть новое тестовое окружение',
        'description' => 'Добавить новый пункт в главное меню',
        'status_id' => 2,
        'created_by_id' => 6,
        'assigned_to_id' => 2,
        'labels' => [
            2, 6, 10
        ]
    ],

    [
        'name' => 'Протестировать корзину',
        'description' => 'Протестировать корзину из другой локации, есть подозрение что из за локации баг',
        'status_id' => 3,
        'created_by_id' => 2,
        'assigned_to_id' => 5,
        'labels' => [
            5, 6, 8, 9
        ]
    ],

    [
        'name' => 'Интеграция платёжного шлюза MasterCard (research)',
        'description' => 'Интеграция платёжного шлюза MasterCard. Выбрать альтернативы, изучить документацию.',
        'status_id' => 4,
        'created_by_id' => 4,
        'assigned_to_id' => 1,
        'labels' => [
            3, 6
        ]
    ],

    [
        'name' => 'Интеграция платёжного шлюза MasterCard (integration)',
        'description' => 'Интеграция платёжного шлюза MasterCard. Интеграция на Back-End.',
        'status_id' => 4,
        'created_by_id' => 4,
        'assigned_to_id' => 1,
        'labels' => [
            3, 9, 12
        ]
    ],

    [
        'name' => 'Разработать дизайн лендинга для нового промо',
        'description' => 'Разработать дизайн лендинга для нового промо, в Figma',
        'status_id' => 4,
        'created_by_id' => 3,
        'assigned_to_id' => 4,
        'labels' => [
            2, 11
        ]
    ],
];
