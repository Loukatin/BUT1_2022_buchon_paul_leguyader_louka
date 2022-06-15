<?php

$settings = parse_ini_file("db.ini", TRUE);

define('DB_DRIVER', $settings['database']['driver']);
define('DB_HOST', $settings['database']['host']);
define('DB_PORT', $settings['database']['port']);
define('DB_USERNAME', $settings['database']['username']);
define('DB_PASSWORD', $settings['database']['password']);
define('DB_DATABASE', $settings['database']['schema']);

define('TABLE_PAGES', 'pages');
try {
    $DB = new PDO(DB_DRIVER . ':host=' . DB_HOST .';port=' . DB_PORT .';dbname=' . DB_DATABASE, DB_USERNAME, DB_PASSWORD);
} catch (Exception $ex) {
    echo $ex->getMessage();
    die;
    }

?>