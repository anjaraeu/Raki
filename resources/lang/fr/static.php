<?php

return [

    'privacy' => [
        'title' => 'Vie privée',
        'list' => [
            'files' => [
                '_' => 'Les fichiers, leur nom, leur somme de contrôle sha256 ainsi que leur taille',
                'desc' => 'Ces fichiers sont stockés pendant la durée de rétention que vous avez configuré.'
            ],
            'groups' => [
                '_' => 'Les groupes de fichiers, leur nom, leur archive zip',
                'desc' => 'Ces groupes sont stockés tant que les fichiers du groupe le sont.'
            ],
            'ip' => [
                '_' => 'Votre adresse Internet (IP), votre référent (Referer) ainsi que votre agent utilisateur.',
                'desc' => 'Ces données sont stockés au maximum 1 an sur notre serveur.'
            ],
            'sentry' => [
                '_' => 'Journaux d\'erreur',
                'desc' => 'Nos fichiers d\'erreur sont interprétés par une instance Sentry.'
            ]
        ]
    ]

];
