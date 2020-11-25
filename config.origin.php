<?php
    define("SITE_NAME", "Кухни форевер");

    define("DB_HOST", 'localhost');
    define("DB_USER", '*******');
    define("DB_PASS", '*******');
    define("DB_NAME", '*******');
    define("DB_PORT", '*******');
    define("DB_PREFIX", '');
    define("DEBUG_MODE", 0);      // включить режим отладки (значения 1 или 0)
    
    $protocol = (isset($_SERVER['HTTPS']) && 'on' == $_SERVER['HTTPS']) ? 'https' : 'http';
    define("BASE_HOST", $protocol."://".$_SERVER['HTTP_HOST']."/");
    define("IMG_DIR", BASE_HOST."images");
    define("BASE_ROOT", __DIR__);
