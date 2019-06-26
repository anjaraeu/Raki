<?php

return [

    'welcome' => [
        '_' => '":name" on :app',
        'synopsis' => 'This file is available on :app. It\'ll expire on the :date.|This :app group is a :files files group. They\'ll expire on the :date.'
    ],

    'download' => [
        '_' => 'Download as ZIP',
        'tooltip' => 'The generation of the Zip archive may take some time, the archive will be downloaded automatically when it is ready.',
        'wait' => '.zip archive is being generated, please wait. This page refreshs automatically.'
    ],

    'uploaded' => 'Your files are online!',
    'links' => [
        'share' => 'Share link',
        'delete' => 'Deletion link'
    ],
    'copy' => 'Copy',

    'manage' => [
        'title' => 'Manage your upload',
        'info' => 'Here, you can delete your download. If you lost your managment password, we can\'t delete your files.',
        'desc' => 'This group contains :files file|This group contains :files files',
        'delete' => [
            'file' => 'Delete file',
            'group' => 'Delete group'
        ],
        'deleted' => 'This file was successfully deleted.',
        'form' => [
            'url' => [
                '_' => 'Group link',
                'placeholder' => url('/g/...')
            ],
            'password' => [
                '_' => 'Password',
                'placeholder' => 'e619822bbb7e83ebb6f84893f961ae529906612e'
            ],
            'submit' => 'Manage your upload'
        ]
    ],

    'encrypted' => [
        '_' => 'This group is encrypted',
        'desc' => 'The files are readable only by using its password defined by the person who shared that group.',
        'ziptooltip' => 'This archive is encrypted with the group\'s password.',
        'modal' => [
            'title' => 'Decrypt file',
            'content' => 'Please enter password to decrypt :file.',
            'password' => 'Password',
            'submit' => 'Download',
            'err' => 'Password is incorrect, please check your input.'
        ]
    ]

];
