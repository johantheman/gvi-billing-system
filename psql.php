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

$result = pg_query($dbconn, "select * from users");
if(!$result){
    echo "there was an issue with the SQL <br>";
} else {
    while ($row = pg_fetch_row($result)) {
        echo "Name: $row[0]  E-mail: $row[1] Org: $row[2] Pod: $row[3] BillingId: $row[4] IsActive: $row[5] SendTotal: $row[6] <br>";
    }
}

