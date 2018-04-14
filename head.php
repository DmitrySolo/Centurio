<?php
/**
 * Created by PhpStorm.
 * User: disol
 * Date: 05.04.2018
 * Time: 12:40
 */
require_once('libs/simple_html_dom.php');
require_once ('Centurio.php');


set_time_limit(0);
ini_set('memory_limit', '1024M');
ini_set('max_input_time ', '99999');

function connect(){
    /* Подключение к базе данных MySQL с помощью вызова драйвера */
    $dsn = 'mysql:dbname=centurio;host=127.0.0.1';
    $user = 'root';
    $password = '';

    try {
        $DB = new PDO($dsn, $user, $password);
    } catch (PDOException $e) {
        echo 'Подключение не удалось: ' . $e->getMessage();
    }
    return $DB;
};

$Centurio = new Centurio();
$DB = connect();
$DB->exec('SET CHARACTER SET utf8');
session_start();
