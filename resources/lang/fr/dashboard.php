<?php

return [

    '_' => 'Tableau de bord',

    'admin' => [
        '_' => 'Panneau administrateur',
        'buttons' => [
            'horizon' => 'Accéder à la console Horizon',
            'delete' => 'Supprimer',
            'keep' => 'Marquer comme lu'
        ],
        'stats' => [
            'files' => 'Fichiers',
            'groups' => 'Groupes',
            'users' => 'Utilisateurs',
            'reports' => 'Rapports non traités'
        ],
        'table' => [
            'title' => 'Rapports non traités',
            'action' => 'Action'
        ]
    ],

    'page' => [
        'header' => [
            'top' => 'Bonjour :user !',
            'subheader' => 'Vous avez :groups groupe en ligne.|Vous avez :groups groupes en ligne.'
        ],

        'table' => [
            'header' => 'Groupes',
            'manage' => 'Gérer le groupe',
            'delete' => 'Supprimer le groupe',
            'footer' => 'Vous êtes propriétaire de ces groupes.',
            'empty' => 'Vous n\'avez pas mis en ligne de fichiers, pour l\'instant.'
        ]
    ]

];
