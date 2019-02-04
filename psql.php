<?php
/**
 * Created by PhpStorm.
 * User: admin
 * Date: 2019/02/02
 * Time: 20:30
 */

$conn_string = "host=localhost port=5433 dbname=postgres user=postgres password=123";
if(pg_connect($conn_string)){
    $dbconn = pg_connect($conn_string);
    echo "PGSQL connection successful <br>";
} else {
    echo "PGSQL there was an issue connecting <br>";
}

$MailingId = "123";
$Reportid = "122122122";

$result = pg_query($dbconn, "INSERT INTO mailings VALUES($MailingId,$Reportid,' ',' ',' ',' ',' ',' ', ' ',' ',' ',' ',' ')");


