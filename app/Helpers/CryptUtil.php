<?php

namespace App\Helpers;

use LaravelAEAD\Encrypter;

class CryptUtil {

    public static function getEncrypter($password) {
        $passwd = hash('sha256', $password);
        return new Encrypter(hash_pbkdf2('sha256', $passwd, env('APP_KEY'), 25, 32, true));
    }

    public static function getKeyEncrypter($key) {
        return new Encrypter($key);
    }

    public static function getKey($password) {
        return hash_pbkdf2('sha256', hash('sha256', $password), env('APP_KEY'), 25, 32, true);
    }

}
