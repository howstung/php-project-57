<?php

return [

    'modal_delete' => [
        'delete' => 'Удалить',
        'sure' => 'Вы уверены ?',
        /*'will_be_deleted' => 'Будет удалён :entity',*/
        'cancel' => 'Отмена',
        'ok' => 'OK',
    ],

    'table' => [
        'id' => '#',
        'name' => 'Имя',
        'description' => 'Описание',
        'created_at' => 'Дата создания',
        'actions' => 'Действия',
        'status' => 'Статус',
        'author' => 'Автор',
        'executor' => 'Исполнитель',
        'labels' => 'Метки',
    ],

    'submit' => [
        'store' => 'Создать',
        'update' => 'Обновить',
        'edit' => 'Изменить'
    ],

    'label' => [
        'name' => 'Метка',
        'pages' => [
            'index' => [
                'title' => 'Метки',
                'new' => 'Создать метку',
            ],
            'store' => [
                'title' => 'Создать метку',
            ],
            'update' => [
                'title' => 'Изменение метки',
            ],
        ],
        'modal' => [
            'will_be_deleted' => 'Будет удалена метка',
        ],
    ],

    'task_status' => [
        'name' => 'Статус',
        'pages' => [
            'index' => [
                'title' => 'Статусы',
                'new' => 'Создать статус',
            ],
            'store' => [
                'title' => 'Создать статус',
            ],
            'update' => [
                'title' => 'Изменение статуса',
            ],
        ],
        'modal' => [
            'will_be_deleted' => 'Будет удалён статус',
        ],
    ],

    'task' => [
        'name' => 'Задача',
        'filter' => [
            'submit' => 'Применить',
        ],
        'pagination' => [
            'showing' => 'Показаны результаты',
            'from' => 'с',
            'to' => 'по',
            'of' => 'из',
        ],
        'pages' => [
            'index' => [
                'title' => 'Задачи',
                'new' => 'Создать задачу',
            ],
            'store' => [
                'title' => 'Создать задачу',
            ],
            'update' => [
                'title' => 'Изменение задачи',
            ],
            'show' => [
                'title' => 'Просмотр задачи',
            ],
        ],
        'modal' => [
            'will_be_deleted' => 'Будет удалена задача',
        ],
    ],
];
