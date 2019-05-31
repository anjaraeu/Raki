<?php

return [

    'welcome' => [
        '_' => '":name" sur AnjaraFiles',
        'synopsis' => 'Ce fichier est disponible sur AnjaraFiles. Il expirera le :date.|Ce groupe AnjaraFiles est un groupe de :files fichiers. Ils expireront le :date.'
    ],

    'download' => [
        '_' => 'Tout télécharger',
        'tooltip' => 'La génération de l\'archive .zip peut prendre un certain temps, l\'archive sera téléchargée automatiquement une fois prête.'
    ],

    'passwd' => 'Merci de noter ce mot de passe, il vous servira à supprimer les fichiers : :passwd. Vous pouvez aussi sauvegarder ce lien : :url',

    'manage' => [
        'title' => 'Gérer votre téléchargement',
        'info' => 'Ici, vous pouvez supprimer votre téléchargement. Si vous avez perdu le mot de passe de gestion, nous ne serons pas en mesure ',
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
