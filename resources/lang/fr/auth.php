<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Authentication Language Lines
    |--------------------------------------------------------------------------
    |
    | The following language lines are used during authentication for various
    | messages that we need to display to the user. You are free to modify
    | these language lines according to your application's requirements.
    |
    */

    'failed' => 'Ces identifiants ne correspondent pas à nos enregistrements.',
    'throttle' => 'Trop de tentatives de connexion. Merci de réesayer dans :seconds secondes.',
    'login' => 'Se connecter',
    'register' => 'S\'inscrire',
    'logout' => 'Se déconnecter',

    'policy' => [
        '_' => 'Merci de lire la :link. En cliquant sur "S\'inscrire", vous acceptez la politique de confidentialité.',
        'link' => 'politique de confidentialité'
    ],
    'username' => 'Pseudonyme',
    'email' => 'Adresse e-mail',
    'password' => 'Mot de passe',
    'confirm-password' => 'Confirmation du mot de passe',
    'rememberme' => 'Se souvenir de moi',
    'password-forgot' => 'Mot de passe oublié ?',

    'reset' => [
        'title' => 'Réinitialiser son mot de passe',
        'submit' => 'Envoyer le lien de réinitialisation du mot de passe',
        'resetbtn' => 'Réinitialiser le mot de passe',
    ],

    'error' => 'Merci de vérifier ces erreurs et de réesayer :',
    'oldpasswd' => 'Ancien mot de passe incorrect',

    'emailcheck' => [
        'title' => 'Vérifiez votre adresse e-mail',
        'sent' => 'Un nouveau lien de vérification a été envoyé à votre adresse.',
        'one' => 'Pour continuer, merci de vérifier votre boîte e-mail pour notre e-mail de vérification.',
        'two' => [
            '_' => 'Si vous n\'avez pas reçu l\'e-mail, :link.',
            'link' => 'cliquez ici pour en envoyer un nouveau'
        ]
    ],

    'anonymous' => 'Anonyme'

];
