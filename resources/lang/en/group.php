<?php

return [

    'welcome' => [
        '_' => '":name" on :app',
        'synopsis' => 'This file is available on :app. It\'ll expire on the :date.|This :app group is a :files files group. They\'ll expire on the :date.'
    ],

    'layout' => [
        'table' => [
            'file' => 'File|Files',
            'sha256' => 'SHA256 checksum'
        ]
    ],

    'download' => [
        '_' => 'Download as ZIP',
        'single' => 'Download',
        'tooltip' => 'The generation of the Zip archive may take some time, the archive will be downloaded automatically when it is ready.',
        'wait' => '.zip archive is being generated, please wait. This page refreshs automatically.'
    ],

    'short' => [
        'header' => 'Now the link is short!',
        '_' => 'We linked our AnjaraLink instance to help you share files easier! Enjoy!'
    ],

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
        ],
        'wait' => [
            'title' => 'Merci de patienter...',
            'message' => 'Le groupe est encore en cours de chiffrement. Les fichiers ne sont pas disponibles durant cette période.'
        ]
    ],

    'report' => [
        '_' => 'Report group',
        'create' => 'Report ":group"',
        'err' => [
            'dmca' => 'You must accept the conditions.',
            'password' => 'The password is incorrect.'
        ],
        'encrypted' => [
            '_' => 'WARNING !',
            'disclaimer' => 'This group is encrypted, so you need to supply the group password to let the moderation check the files. Keep that in mind, the password cannot be changed.'
        ],
        'reason' => [
            '_' => 'How does the content of this group violate our terms of use?',
            'placeholder' => 'Choose a reason',
            'spam' => 'This content is useless and spam our infrastructures.',
            'identity' => 'This content is doing identity theft.',
            'shock' => 'This content is offensive, obscene, (child) pornography, incites hatred or suicide/self-mutilation.',
            'copyright' => 'This content include copyright infringement (DMCA takedown).',
            'confidential' => 'This content is confidential or violates personal rights.'
        ],
        'cp' => [
            'who' => [
                '_' => 'Copyright holder name',
                'placeholder' => 'Corporation name or Person name'
            ],
            'what' => [
                '_' => 'Copyrighted content name',
                'placeholder' => 'Content name'
            ],
            'dmca' => 'I understand that making fake DMCA reports can lead to a ban of our network.',
            'sign' => [
                '_' => 'Sign here',
                'placeholder' => 'Put in your complete name.'
            ]
        ],
        'identity' => [
            'who' => [
                '_' => 'Who is target of identity theft?',
                'placeholder' => 'Name'
            ]
        ],
        'password' => [
            '_' => 'Password',
            'placeholder' => 'Used for decrypting the files'
        ],
        'submit' => 'Submit report',
        'done' => 'Thanks! You will be taken to home.'
    ]

];
