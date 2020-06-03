<?php

if (!function_exists('hfs')) {
    /**
     * Convert byte size to human-readable size
     *
     * @param Integer The byte size
     * @param Integer Number of digits after decimal point
     * @return string
     */
    function hfs($bytes, $decimals = 2) {
        $size = array('B','kB','MB','GB','TB','PB','EB','ZB','YB');
        $factor = floor((strlen($bytes) - 1) / 3);
        return sprintf("%.{$decimals}f", $bytes / pow(1024, $factor)) . @$size[$factor];
    }
}

if (!function_exists('normalizeUtf8String')) {

    /**
     * Normalize string to avoid non-ASCII errors in headers
     *
     * @param string $s
     * @return string|string[]
     */
    function normalizeUtf8String(string $s)
    {
        $trans = Transliterator::createFromRules(':: Any-Latin; :: Latin-ASCII; :: NFC;', Transliterator::FORWARD);
        return $trans->transliterate($s);
    }

}

