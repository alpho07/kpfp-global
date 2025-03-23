<?php

return array(

    'dir' => ['files'],

    'disks' => [
        'public' => [
            'driver' => 'local',
            'path' => storage_path('app/public/files'),
            'URL' => env('APP_URL') . '/storage/files',
            'visibility' => 'public',
        ],
    ],


    'route' => [
        'prefix' => 'elfinder',
        'middleware' => array('web', 'auth'), //Set to null to disable middleware filter
    ],



  //  'access' => 'Barryvdh\Elfinder\Elfinder::checkAccess',



    'roots' => [
        [
            'driver' => 'LocalFileSystem',
            'path' => storage_path('app/public/files'),
            'URL' => env('APP_URL') . '/storage/files',
            'accessControl' => 'Barryvdh\Elfinder\Elfinder::checkAccess',
        ]
    ],




    'options' => array(),

    'root_options' => array(),

);
