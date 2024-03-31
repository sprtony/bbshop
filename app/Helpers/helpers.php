<?php

use App\Facades\Settings;

if (! function_exists('setting')) {
    function setting($key, $default = null)
    {
        return Settings::setting($key, $default);
    }
}

if (! function_exists('slugify')) {
    function slugify($string)
    {
        // Remove all non-word characters.
        $string = preg_replace('/[^\w\p{Z} -]/', '', $string);

        // Replace all spaces with hyphens.
        $string = preg_replace('/ +/', '-', $string);

        // Lowercase the string.
        $string = strtolower($string);

        return $string;
    }
}

if (! function_exists('generateSVG')) {
    function generateSVG($path, $class = '')
    {
        // Create the dom document as per the other answers
        $svg = new \DOMDocument();
        $path = storage_path('app/public/'.$path);
        $svg->load($path);
        $svg->documentElement->setAttribute('class', $class);
        $output = $svg->saveXML($svg->documentElement);

        return $output;
    }
}
