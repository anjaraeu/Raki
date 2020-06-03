<?php

return [

    'welcome' => [
        '_' => '":name" sur :app',
        'synopsis' => 'Ce fichier est disponible sur :app. Il expirera le :date.|Ce groupe :app se compose de :files fichiers. Il expirera le :date.'
    ],

    'layout' => [
        'table' => [
            'file' => 'Fichier|Fichiers',
            'sha256' => 'Somme de contrôle SHA256'
        ]
    ],

    'download' => [
        '_' => 'Télécharger en ZIP',
        'single' => 'Télécharger',
        'tooltip' => 'La génération de l\'archive .zip peut prendre un certain temps, l\'archive sera téléchargée automatiquement une fois prête.',
        'wait' => 'L\'archive est en train d\'être générée, cette page se rafraîchit automatiquement.'
    ],

    'short' => [
        'header' => 'Les liens sont courts !',
        '_' => 'Nous avons connecté notre système AnjaraLink pour vous aider à partager vos fichiers.'
    ],

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
        ],
        'wait' => [
            'title' => 'Merci de patienter...',
            'message' => 'Le groupe est encore en cours de chiffrement. Les fichiers ne sont pas disponibles durant cette période.'
        ]
    ],

    'report' => [
        '_' => 'Signaler ce groupe',
        'create' => 'Signaler ":group"',
        'err' => [
            'dmca' => 'Vous devez accepter les conditions.',
            'password' => 'Le mot de passe est incorrect'
        ],
        'encrypted' => [
            '_' => 'ATTENTION !',
            'disclaimer' => 'Ce groupe étant chiffré, afin que la modération puisse vérifier le signalement, il faudra fournir le mot de passe du groupe. Gardez bien à l\'esprit qu\'il est impossible de le changer et que nous serons en mesure de consulter vos fichiers.'
        ],
        'reason' => [
            '_' => 'En quoi le contenu de ce groupe viole nos conditions d\'utilisation ?',
            'placeholder' => 'Sélectionnez un motif',
            'spam' => 'Ce contenu est inutile et vise à "spammer" nos infrastructures.',
            'identity' => 'Ce contenu sert à l\'usurpation d\'identité ou ce contenu usurpe une identité.',
            'shock' => 'Ce contenu est choquant, obscène, à caractère pédo·pornographique, incite à la haine ou au suicide/auto-mutilation.',
            'copyright' => 'Ce contenu viole la propriété intellectuelle d\'un tiers ou de moi-même.',
            'confidential' => 'Ce contenu n\'a pas être divulgué publiquement ou porte atteinte à une personne en particulier (droit image).'
        ],
        'cp' => [
            'who' => [
                '_' => 'Qui est victime de violation de droits d\'auteur ?',
                'placeholder' => 'Raison sociale, nom et prénom'
            ],
            'what' => [
                '_' => 'Quel est le nom du contenu incriminé ?',
                'placeholder' => 'Nom du contenu'
            ],
            'dmca' => 'Je jure sur l\'honneur de l\'exactitude du formulaire et que les signalements abusifs peuvent entraîner une interdiction d\'émettre de futurs rapports.',
            'sign' => [
                '_' => 'Votre signature',
                'placeholder' => 'Votre nom complet agit comme une signature papier classique'
            ]
        ],
        'identity' => [
            'who' => [
                '_' => 'Qui est victime d\'usurpation d\'identité ?',
                'placeholder' => 'Nom et prénom'
            ]
        ],
        'password' => [
            '_' => 'Mot de passe',
            'placeholder' => 'Il servira à déchiffrer les fichiers pour voir leur contenu'
        ],
        'submit' => 'Soumettre un signalement',
        'done' => 'Merci ! Vous allez être redirigé vers l\'accueil.'
    ]

];
