<?php

return [

    'privacy' => [
        'title' => 'Privacy',
        'list' => [
            'files' => [
                '_' => 'Files, their names, their sha256 checksums and their sizes',
                'desc' => 'Their files are stored during the data retention period the uploader '
            ],
            'groups' => [
                '_' => 'File groups, their names, their .zip archives',
                'desc' => 'These groups are stored whenever the files are stored.'
            ],
            'ip' => [
                '_' => 'Your Internet Address (IP), your referer and your User Agent.',
                'desc' => 'These data can be stored for 1 year.'
            ],
            'sentry' => [
                '_' => 'Error logs',
                'desc' => 'Our errors logs are parsed by a Sentry instance.'
            ]
        ]
    ]

];
