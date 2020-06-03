<?php

namespace App\Helpers;

use FileVault;

class CryptUtil {

    /**
     * Generate an encrypter class with the good key
     *
     * @param string $password
     * @param bool $hashed If true, the password won't be hashed
     * @return \SoareCostin\FileVault\FileVault
     */
    public static function getEncrypter($password, $hashed = false) {
        $passwd = $hashed ? $password:hash('sha256', $password);
        return FileVault::key(hash_pbkdf2('sha256', $passwd, env('APP_KEY'), 25, 32, true));
    }

    public static function getKeyEncrypter($key) {
        return FileVault::key($key);
    }

    public static function getKey($password, $hashed = false) {
        $passwd = $hashed ? $password:hash('sha256', $password);
        return hash_pbkdf2('sha256', $passwd, env('APP_KEY'), 25, 32, true);
    }

}
