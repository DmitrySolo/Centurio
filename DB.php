<?php
/**
 * Created by PhpStorm.
 * User: disol
 * Date: 02.04.2018
 * Time: 15:29
 */
function connect(){
    /* Подключение к базе данных MySQL с помощью вызова драйвера */
    $dsn = 'mysql:dbname=centurio;host=127.0.0.1';
    $user = 'root';
    $password = 'root';

    try {
        $DB = new PDO($dsn, $user, $password,array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"));
    } catch (PDOException $e) {
        echo 'Подключение не удалось: ' . $e->getMessage();
    }
    return $DB;
};


