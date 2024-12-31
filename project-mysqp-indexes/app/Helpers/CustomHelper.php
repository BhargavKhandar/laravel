<?php

// Function to capitalize the first letter of each word
if (!function_exists('capitalizeWords')) {
    function capitalizeWords($string)
    {
        return ucwords(strtolower($string));
    }
}

// Function to format a date
if (!function_exists('formatDate')) {
    function formatDate($date, $format = 'Y-m-d')
    {
        try {
            return \Carbon\Carbon::parse($date)->format($format);
        } catch (\Exception $e) {
            return null;
        }
    }
}

// Function to convert string to lowercase
if (!function_exists('toLowerCase')) {
    function toLowerCase($string)
    {
        return strtolower($string);
    }
}
