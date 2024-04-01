<?php

return [

    'title' => 'Task Manager',

    'menu' => [
        'items' => [
            'main' => 'Main',
            'tasks' => 'Tasks',
            'task_statuses' => 'Task Statuses',
            'labels' => 'Labels'
        ],
        'profile' => [
            'login' => 'Log In',
            'register' => 'Register',
            'logout' => 'Log Out'
        ]
    ],

    'pages' => [
        'welcome' => [
            'h1' => 'PHP project for Hexlet!',
            'p' => 'This is a simple Laravel task manager'
        ],
    ],


    'label' => [
        'table' => [
            'id' => '#',
            'name' => 'Name',
            'description' => 'Description',
            'created_at' => 'Created At',
            'actions' => 'Actions',
        ],
        'pages' => [
            'index' => [
                'title' => 'Labels',
                'new' => 'Create label',
                'edit' => 'Edit'
            ],
            'create' => [
                'title' => 'Create label',
                'submit' => 'Create'
            ],
            'edit' => [
                'title' => 'Edit Label',
                'submit' => 'Edit'
            ]
        ],
        'modal' => [
            'delete' => 'Delete',
            'sure' => 'Are you sure ?',
            'will_be_deleted' => 'The Label will be deleted',
            'cancel' => 'Cancel',
            'ok' => 'OK'
        ],
        'flash' => [
            'store' => 'Market created successfully',
            'update' => 'Market updated successfully',
            'destroy' => [
                'success' => 'Label deleted successfully',
                'fail' => 'Failed to remove Label',
            ],
        ],
    ],


    'task_status' => [
        'table' => [
            'id' => '#',
            'name' => 'Name',
            'created_at' => 'Created At',
            'actions' => 'Actions',
        ],
        'pages' => [
            'index' => [
                'title' => 'Task Statuses',
                'new' => 'Create Status',
                'edit' => 'Edit'
            ],
            'create' => [
                'title' => 'Create Status',
                'submit' => 'Create'
            ],
            'edit' => [
                'title' => 'Edit status',
                'submit' => 'Edit'
            ],
        ],
        'modal' => [
            'delete' => 'Delete',
            'sure' => 'Are you sure ?',
            'will_be_deleted' => 'Task Status will be deleted',
            'cancel' => 'Cancel',
            'ok' => 'OK'
        ],
        'flash' => [
            'store' => 'Task Status created successfully',
            'update' => 'Task Status updated successfully',
            'destroy' => [
                'success' => 'Task Status deleted successfully',
                'fail' => 'Failed to remove Task Status',
            ],
        ],
    ],


    'task' => [
        'table' => [
            'id' => '#',
            'description' => 'Description',
            'status' => 'Status',
            'name' => 'Name',
            'author' => 'Author',
            'executor' => 'Executor',
            'created_at' => 'Created At',
            'actions' => 'Actions',
            'labels' => 'labels'
        ],
        'filter' => [
            'submit' => 'Apply'
        ],
        'pagination' => [
            'showing' => 'Showing',
            'from' => 'from',
            'to' => 'to',
            'of' => 'of',
        ],
        'pages' => [
            'index' => [
                'title' => 'Tasks',
                'new' => 'Create task',
                'edit' => 'Edit',
            ],
            'create' => [
                'title' => 'Create task',
                'submit' => 'Create'
            ],
            'edit' => [
                'title' => 'Edit Task',
                'submit' => 'Edit'
            ],
            'show' => [
                'title' => 'Show task',
                'submit' => 'Create'
            ],
        ],
        'modal' => [
            'delete' => 'Delete',
            'sure' => 'Are you sure ?',
            'will_be_deleted' => 'Task will be deleted',
            'cancel' => 'Cancel',
            'ok' => 'OK'
        ],
        'flash' => [
            'store' => 'Task created successfully',
            'update' => 'Task updated successfully',
            'destroy' => [
                'success' => 'Task deleted successfully',
                'fail' => 'Failed to remove Task',
            ],
        ],
    ]
];
