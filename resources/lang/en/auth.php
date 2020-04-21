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

    'failed' => 'These credentials do not match our records.',
    'throttle' => 'Too many login attempts. Please try again in :seconds seconds.',
    'login' => 'Login',
    'register' => 'Register',

    'policy' => [
        '_' => 'Please review the :link. By clicking "Register", you accept the privacy policy.',
        'link' => 'privacy policy'
    ],
    'username' => 'Username',
    'email' => 'E-Mail Address',
    'password' => 'Password',
    'confirm-password' => 'Confirm Password',
    'rememberme' => 'Remember Me',
    'password-forgot' => 'Forgot Your Password?',

    'reset' => [
        'title' => 'Reset Password',
        'submit' => 'Send Password Reset Link',
        'resetbtn' => 'Reset Password'
    ],

    'error' => 'Please check these errors and retry :',
    'oldpasswd' => 'Wrong old password',

    'emailcheck' => [
        'title' => 'Verify Your Email Address',
        'sent' => 'A fresh verification link has been sent to your email address.',
        'one' => 'Before proceeding, please check your email for a verification link.',
        'two' => [
            '_' => 'If you did not receive the email, :link.',
            'link' => 'click here to request another'
        ]
    ]

];
