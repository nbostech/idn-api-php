<?php
return [
    'client'=> [
        'app'=> [
            'name'=>'app',
            'client.credentials'=> array('client'=>'devConsole-app-client','secret'=>'devConsole-app-secret'),
            'host'=>'http://api.qa1.nbos.in'
            ]
    ],
    'moduleApiServer'=> [
        'todo' => [
            'name'=>'todo',
            'client.credentials'=> array('client'=>'hariome-module-client','secret'=>'hariome-module-secret'),
            'host'=>'http://api.qa1.nbos.in',
            'key' => 'MODK:6521f4f1-4fa4-4762-b7ad-6e6f03ae2eb6'
        ]
    ]
];