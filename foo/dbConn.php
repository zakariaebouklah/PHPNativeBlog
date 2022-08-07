<?php
    $host = 'localhost';
    $userphpadmin = 'root';
    $passwordphpadmin = '';
    $db_name = 'blogphpnative';

    $dsn = "mysql:host=".$host.';dbname='.$db_name;

    $pdo = new PDO($dsn, $userphpadmin, $passwordphpadmin);