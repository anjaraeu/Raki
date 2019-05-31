<?php

return [

    'privacy' => [
        'title' => 'Vie privée',
        // 'p1' => 'Anjara respecte votre vie privée, de ce fait nous tentons d\'être la plus respecteuse de celle-ci. Voici ci-dessous la liste des données susceptibles d\'être collectées lors de l\'utilisation de notre service.',
        'list' => [
            'files' => [
                '_' => 'Les fichiers, leur nom, leur somme de contrôle md5 ainsi que leur taille',
                'desc' => 'Ces fichiers sont stockés pendant la durée de rétention que vous avez configuré.'
            ],
            'groups' => [
                '_' => 'Les groupes de fichiers, leur nom, leur archive zip',
                'desc' => 'Ces groupes sont stockés tant que les fichiers du groupe le sont.'
            ],
            'ip' => [
                '_' => 'Votre adresse Internet (IP), votre référent (Referer) ainsi que votre agent utilisateur.',
                'desc' => 'Ces données sont stockés au maximum 1 an sur notre serveur.'
            ]
        ]
    ]

];
