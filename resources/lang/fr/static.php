<?php

return [

    'legal' => [
        'title' => 'Mentions légales',
        'p1' => 'Ce site Internet est hébergé par l\'association Anjara, dont le siège social se situe au 30 Chemin d\'Apollon, 95320 Saint-Leu-la-Forêt. Cette association utilise les services d\'hébergement de l\'entreprise allemande Hetzner Online GmbH, située au 25 Industriestr., 91710 Gunzenhausen.',
        'terms' => 'Conditions d\'utilisation',
        'p2' => 'L\'association loi 1901 Anjara (30 Chemin d\'Apollon, 95320 Saint-Leu-la-Forêt, "Anjara", "nous", "notre") fournit sur ce site Internet, un service de partage de fichiers dans la limite de 5 fichiers de 500 méga-octets pendant 1 an maximum. Nous acceptons tout type de fichiers, cependant le nom ainsi que le contenu des dits fichiers ne peuvent contenir :',
        'forbid' => [
            'basic' => 'Des contenus violents, abusifs, menaçants, illégaux, obscène, incitant à la haine, visant une personne sous forme d\'harcèlement.',
            'identity' => 'Des contenus visant à usurper l\'identité d\'une tierce personne.',
            'corp' => 'Des contenus confidentiels (d\'entreprises privées et/ou publiques, de gouvernements, etc...)',
            'spam' => 'Des contenus visant à saturer la plateforme d\'éléments inutiles ("spam") ou la répétition de mise en ligne de fichiers identiques.',
            'malware' => 'Des contenus visant à infecter ou endommager les utilisateurs qui vont les utiliser ou l\'infrastructure d\'Anjara',
            'copyright' => 'Des contenus ne respectant pas les droits à la propriété intellectuelle ("copyright") d\'un tiers.'
        ],
        'p3' => 'Anjara se réserve ainsi le droit de supprimer, copier, modifier et lire tout fichier afin de répondre à une procédure judiciaire ou de mettre en application ces conditions. En mettant en ligne des fichiers sur notre plateforme, vous acceptez ces conditions.',
        'p4' => 'Anjara peut être contacté par les personnes concernées pour un retrait de contenu à l\'adresse e-mail suivante `contact@anjara.eu`. Anjara ne peut être tenu responsable des contenus mis en ligne par leurs utilisateurs dans la mesure où aucun filtre n\'est appliqué dessus.',
        'p5' => 'L\'accord de licence AGPLv3 s\'applique à ce site Internet, le code source est disponible. Aucune garantie de résultat n\'est présente même si nous faisons de notre mieux.'
    ],

    'privacy' => [
        'title' => 'Vie privée',
        'p1' => 'Anjara respecte votre vie privée, de ce fait nous tentons d\'être la plus respecteuse de celle-ci. Voici ci-dessous la liste des données susceptibles d\'être collectées lors de l\'utilisation de notre service.',
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
