<?php

return [

    'welcome' => [
        '_' => '":name" sur :app',
        'synopsis' => 'Ce fichier est disponible sur :app. Il expirera le :date.|Ce groupe :app est un groupe de :files fichiers. Ils expireront le :date.'
    ],

    'download' => [
        '_' => 'Télécharger en ZIP',
        'tooltip' => 'La génération de l\'archive .zip peut prendre un certain temps, l\'archive sera téléchargée automatiquement une fois prête.'
    ],

    'uploaded' => 'Vos fichiers sont en ligne !',
    'links' => [
        'share' => 'Lien à partager',
        'delete' => 'Lien pour supprimer les fichiers'
    ],
    'copy' => 'Copier',

    'manage' => [
        'title' => 'Gérer votre téléchargement',
        'info' => 'Ici, vous pouvez supprimer votre téléchargement. Si vous avez perdu le mot de passe de gestion, nous ne serons pas en mesure de supprimer vos fichiers.',
        'desc' => 'Ce groupe contient :files fichier|Ce groupe contient :files fichiers',
        'delete' => [
            'file' => 'Supprimer ce fichier',
            'group' => 'Supprimer ce groupe'
        ],
        'deleted' => 'Ce fichier a été supprimé avec succès.',
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
    ],

    'encrypted' => [
        '_' => 'Ce groupe est chiffré.',
        'desc' => 'Les fichiers sont accessibles uniquement grâce au mot de passe défini par celui ou celle qui a partagé ce groupe.',
        'ziptooltip' => 'Cette archive est chiffrée avec le mot de passe du groupe.',
        'modal' => [
            'title' => 'Déchiffrer un fichier',
            'content' => 'Veuillez entrer le mot de passe du groupe pour déchiffrer :file.',
            'password' => 'Mot de passe',
            'submit' => 'Télécharger',
            'err' => 'Le mot de passe est incorrect, merci de réesayer votre saisie.'
        ]
    ]

];
