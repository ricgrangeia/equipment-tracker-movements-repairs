<?php

return [
    'bsVersion' => '4.x', // this will set globally `bsVersion` to Bootstrap 4.x for all Krajee Extensions
    'bsDependencyEnabled' => false,
    'adminEmail' => 'admin@example.com',
    'senderEmail' => 'equipamentos@example.com',
    'supportEmail' => 'equipamentos@example.com',
    'equipamentoEmail' => 'equipamentos@example.com',
    'senderName' => 'Gestão de Equipamentos',
    'hail812/yii2-adminlte3' => [
        'pluginMap' => [
            'sweetalert2' => [
                'css' => 'sweetalert2-theme-bootstrap-4/bootstrap-4.min.css',
                'js' => 'sweetalert2/sweetalert2.min.js'
            ],
            'toastr' => [
                'css' => 'toastr/toastr.min.css',
                'js' => 'toastr/toastr.min.js'
            ],
        ]
    ],
    /** To change the Users database external do main company database */
    'mdm.admin.configs' => [
        'menuTable' => 'menu',
    ]
];
