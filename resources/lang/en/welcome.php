<?php

return [

    'title' => 'Welcome to '.config('app.name').' !',
    'synopsis' => config('app.name').' is a file sharing system that is easy to use, does not require an account and which doesn\'t track you. Great, no?',

    'groupname' => [
        '_' => 'Name of the upload',
        'placeholder' => 'My wonderful upload !'
    ],

    'loading' => 'Please wait while your files are being uploaded...',

    'error' => [
        '_' => 'Errors happened during your upload',
        'nogroup' => 'There is no files in your upload.',
        'kept' => 'Your files are kept, don\'t reupload them.'
    ],

    'options' => [
        'show' => 'More options',
        'hide' => 'Less options',
        'tooltip' => 'Password, short link, etc...'
    ],

	'disclaimer' => 'Every fields are optional, they\'ll be fulfilled with default values.',

    'expiry' => [
        '_' => 'Expiration date',
        'placeholder' => 'Choose a period',
        'day' => '1 day',
        'week' => '1 week',
        'month' => '1 month',
        'year' => '1 year'
    ],

    'link' => [
        '_' => 'Short link',
        'placeholder' => 'my-awesome-upload',
        'info' => 'This link will be :link'
    ],

    'password' => [
        '_' => 'Password',
	    'placeholder' => 'my awesome password!',
	    'info' => 'Files will be encrypted with this password, it\'ll impossible to recover them if you forgot the password.'
    ],

    'single' => [
        '_' => 'Single download',
        'info' => 'When someone downloads one or more files, they will be deleted from the server.'
    ],

    'submit' => 'Submit!'

];
