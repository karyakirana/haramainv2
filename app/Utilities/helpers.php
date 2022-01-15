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

if (!function_exists('tanggalan_database_format')){
    function tanggalan_database_format($tanggal, $format): string
    {
        return \Carbon\Carbon::createFromFormat($format, $tanggal)->format('Y-m-d');
    }
}

if (!function_exists('tanggalan_format')){
    function tanggalan_format($tanggal)
    {
        return \Carbon\Carbon::parse($tanggal)->format('d-M-Y');
    }
}
