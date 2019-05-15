<?php

if (!function_exists('hfs')) {
    /**
     * Convert byte size to human-readble size
     *
     * @param Integer The byte size
     * @param Integer Number of digits after decimal point
     */
    function hfs($bytes, $decimals = 2) {
        $size = array('B','kB','MB','GB','TB','PB','EB','ZB','YB');
        $factor = floor((strlen($bytes) - 1) / 3);
        return sprintf("%.{$decimals}f", $bytes / pow(1024, $factor)) . @$size[$factor];
    }
}
