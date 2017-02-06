<?php


return [
    'enablePrettyUrl' => true,
    'showScriptName' => false,
    'enableStrictParsing' => true,
    'baseUrl' => '/',
    'suffix' => '/',
    'scriptUrl'=>'/frontend/index.php',
    'rules' => [
        '' => 'site/index',

        'user' => 'user/index',
        'blogcategory' => 'blogcategory/index',
        'blog' => 'blog/index',
        'language' => 'language/index',
        'page' => 'page/index',
        'gallery' => 'gallery/index',
        'page/index' => 'page/index',
        'page/<url:.+>' => 'page/view',
        'blog/index' => 'blog/index',
        'blog/<url:.+>' => 'blog/view',
        'blogcategory/<url:.+>' => 'blogcategory/view',
        'gallery/<url:.+>' => 'gallery/index',
        'faq' => 'faq/index',

        '<controller:\w+>/<id:\d+>/<action:(create|update|delete)>' => '<controller>/<action>',
        '<controller:\w+>/<action:\w+>' => '<controller>/<action>',
        '<controller:\w+>' => '<controller>/index',
    ],
];