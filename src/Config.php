<?php

define("ENV", parse_ini_file(realpath(dirname(__FILE__, 2) . "/env.ini")));
define("ROOT", ENV["app_url"]);
define("DATA_LAYER", [
    "driver" => ENV["db_driver"],
    "host" => ENV["db_host"],
    "port" => ENV["db_port"],
    "dbname" => ENV["db_name"],
    "username" => ENV["db_username"],
    "passwd" => ENV["db_passwd"],
    "options" => [
        PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8",
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_OBJ,
        PDO::ATTR_CASE => PDO::CASE_NATURAL
    ]
]);
define("SITE_NAME", ENV["app_name"]);
define("SESS_NAME", ENV["app_sessname"]);
define("MESSAGE_NAME", ENV["app_messagename"]);
define('MAIL', [
    'host' => ENV["mail_host"],
    'port' => ENV["mail_port"],
    'username' => ENV["mail_username"],
    'password' => ENV["mail_passwd"],
    'name' => ENV["mail_password"],
    'email' => ENV["mail_email"]
]);