<?php // Настройки для подключения к базе данных

// Для Mamp
// return [
//     'db' => [
//         'host' => 'localhost:8889', // host и порт заданный в MAMP для SQL
//         'dbname' => 'my_project',
//         'user' => 'root',
//         'password' => 'root',
//     ]
// ];

// Для Wamp
return [
    'db' => [
        'host' => 'localhost:3306', // host и порт заданный в Wamp для SQL
        'dbname' => 'service_travelers',
        'user' => 'root',
        'password' => '',
    ]
];
