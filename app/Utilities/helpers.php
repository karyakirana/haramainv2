<?php

if (!function_exists('rupiah_format')){
    function rupiah_format($number)
    {
        return number_format($number, 0, ",", ".");
    }
}

if (!function_exists('diskon_format')){
    function diskon_format($value, $angkaBelakangKoma)
    {
        return number_format($value, $angkaBelakangKoma,",", ".");
    }
}
