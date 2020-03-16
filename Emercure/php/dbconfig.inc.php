<?php

    $hostlocal='localhost';
    $dbnamelocal = 'BD_Project';
    $usernamelocal = 'postgres';
    $passwordlocal = 'kinda';

    $host='devwebdb.etu';
    $dbname = 'db2019l3i_e_odiallo';
    $username = 'y2019l3i_e_odiallo';
    $password = 'A123456*';

    $dsn = "pgsql:host=$host;port=5432;dbname=$dbname;user=$username;password=$password";
    //$dsn = "pgsql:host=$hostlocal;port=5432;dbname=$dbnamelocal;user=$usernamelocal;password=$passwordlocal";
    $conn = new PDO($dsn);


?>