<?php

return [

    'welcome' => [
        '_' => '":name" sur AnjaraFiles',
        'synopsis' => 'Ce groupe AnjaraFiles est un groupe de fichiers'
    ],

    'download' => [
        '_' => 'Tout télécharger',
        'tooltip' => 'La génération de l\'archive .zip peut prendre un certain temps, l\'archive sera téléchargée automatiquement une fois prête.'
    ],

    'passwd' => 'Merci de noter ce mot de passe, il vous servira à supprimer les fichiers : :passwd',

    'manage' => [
        'desc' => 'Ce groupe contient :files fichier|Ce groupe contient :files fichiers',
        'delete' => [
            'file' => 'Supprimer ce fichier',
            'group' => 'Supprimer ce groupe'
        ],
        'form' => [
            'url' => [
                '_' => 'Lien du groupe',
                'placeholder' => url('/g/...')
            ],
            'password' => [
                '_' => 'Mot de passe de gestion',
                'placeholder' => 'e619822bbb7e83ebb6f84893f961ae529906612e'
            ],
            'submit' => 'Gérer votre téléchargement'
        ]
    ]

];
