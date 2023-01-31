<?php

define("ROOT", "http://localhost");
define("DATA_LAYER", [
    "driver" => "mysql",
    "host" => "localhost",
    "port" => "3308",
    "dbname" => "services",
    "username" => "root",
    "passwd" => "root",
    "options" => [
        PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8",
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_OBJ,
        PDO::ATTR_CASE => PDO::CASE_NATURAL
    ]
]);
define("SITE_NAME", "Services");
define("SESS_NAME", "user_se");
define("MESSAGE_NAME", "message");
define('MAIL', [
    'host' => 'mail.hospedasmart.com.br',
    'port' => '465',
    'username' => '_mainaccount@hospedasmart.com.br',
    'password' => 'hospeda@net12',
    'name' => 'GTGNG - Services',
    'email' => 'contato@gtgng.software'
]);