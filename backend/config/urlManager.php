<?php


return [
    'enablePrettyUrl' => true,
    'showScriptName' => false,
    'enableStrictParsing' => true,
    'baseUrl' => '/admin',
    'suffix' => '/',
    'scriptUrl'=>'/backend/index.php',
    'rules' => [
        '' => 'settings/index',

        'user' => 'user/index',

        '<controller:\w+>/<id:\d+>/<action:(create|update|delete)>' => '<controller>/<action>',
        '<controller:\w+>/<action:\w+>' => '<controller>/<action>',
        '<controller:\w+>' => '<controller>/index',
    ],
];