<?php

return [

    'title' => 'Bievenue sur '.config('app.name').' !',
    'synopsis' => config('app.name').' est un système de partage de fichiers simple à utiliser, ne nécissitant pas de compte et qui ne vous piste pas. Génial, non ?',

    'groupname' => [
        '_' => 'Nom du téléchargement',
        'placeholder' => 'Mon super upload !'
    ],

    'loading' => 'Vos fichiers sont en cours de téléchargement, merci de patienter...',

    'error' => [
        '_' => 'Des erreurs sont survenues durant la création du téléchargement',
        'nogroup' => 'Aucun fichier n\'a été mis en ligne.',
        'kept' => 'Les fichiers que vous avez déjà mis en ligne ne sont pas perdus, resoumettez simplement le formulaire avec le nom et l\'expiration.'
    ],

    'options' => [
        'show' => 'Plus d\'options',
        'hide' => 'Moins d\'options',
        'tooltip' => 'Mot de passe, lien court, etc...'
    ],

    'disclaimer' => 'Tous les champs sont optionnels, ils seront remplis avec des valeurs par défaut le cas échéant.',

    'expiry' => [
        '_' => 'Expiration',
        'placeholder' => 'Choisir une période',
        'day' => '1 jour',
        'week' => '1 semaine',
        'month' => '1 mois',
        'year' => '1 année'
    ],

    'link' => [
        '_' => 'Lien court',
        'placeholder' => 'mon-upload',
        'info' => 'Ce lien sera sous la forme :link'
    ],

    'password' => [
        '_' => 'Mot de passe',
        'placeholder' => 'mon super mot de passe',
        'info' => 'Les fichiers seront chiffrés avec ce mot de passe, il sera impossible pour personne de récupérer les fichiers sans ce dernier.'
    ],

    'single' => [
        '_' => 'Téléchargement unique',
        'info' => 'Lorsque quelqu\'un télécharge un ou des fichiers, ils seront supprimés juste après.'
    ],

    'steps' => [
        '1' => [
            '_' => 'Fichiers',
            'desc' => 'Choisissez vos fichiers',
            'btn' => 'Suivant'
        ],
        '2' => [
            '_' => 'Groupe',
            'desc' => 'Donnez-lui un joli nom !',
            'btn' => 'Publier'
        ],
        '3' => [
            '_' => 'Partager',
            'desc' => 'Copiez le lien et envoyez-le à vos proches.',
            'btn' => 'Recommencer'
        ]
    ],

    'note' => ':size MB par fichier, 5 fichiers maximum'

];
