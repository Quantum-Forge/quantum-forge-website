<?php 

// File: load_env.php

function load_env($file)
{
    if (!file_exists($file)) {
        throw new Exception("File .env tidak ditemukan.");
    }

    $lines = file($file, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
    foreach ($lines as $line) {
        if (strpos(trim($line), '#') === 0) {
            continue;
        }

        list($name, $value) = explode('=', $line, 2);
        $name = trim($name);
        $value = trim($value);

        if (!array_key_exists($name, $_SERVER) && !array_key_exists($name, $_ENV)) {
            putenv(sprintf('%s=%s', $name, $value));
            $_ENV[$name] = $value;
            $_SERVER[$name] = $value;
        }
    }
     // Debug: Print loaded variables
    //  var_dump($_ENV);
}

load_env(__DIR__ . '/../.env');



?>