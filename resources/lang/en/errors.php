<?php

return [

    '401' => [
        'err' => 'Unauthorized'
    ],

    '403' => [
        'err' => 'Forbidden'
    ],

    '404' => [
        'err' => 'Not found'
    ],

    '419' => [
        'err' => 'Page Expired'
    ],

    '429' => [
        'err' => 'Too Many Requests'
    ],

    '500' => [
        'err' => 'Server Error',
        'sentry' => 'To help us, Sentry has sent error data.'
    ],

    '503' => [
        'err' => 'Maintenance',
        'brb' => 'Be right back'
    ],

    'home' => 'Go home'

];
