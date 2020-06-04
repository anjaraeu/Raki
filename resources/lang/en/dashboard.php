<?php

return [

    '_' => 'Dashboard',

    'admin' => [
        '_' => 'Admin panel',
        'buttons' => [
            'horizon' => 'Go to Horizon console',
            'delete' => 'Delete',
            'keep' => 'Mark as read'
        ],
        'stats' => [
            'files' => 'Files',
            'groups' => 'Groups',
            'users' => 'Users',
            'reports' => 'Unread reports'
        ],
        'table' => [
            'title' => 'Unread reports',
            'action' => 'Action'
        ]
    ],

    'page' => [
        'header' => [
            'top' => 'Hello :user!',
            'subheader' => 'You have :groups group uploaded.|You have :groups groups uploaded.'
        ],

        'table' => [
            'header' => 'Groups',
            'manage' => 'Manage group',
            'delete' => 'Delete group',
            'footer' => 'You are the owner of this group.',
            'empty' => 'You haven\'t uploaded any files yet.'
        ]
    ]

];
