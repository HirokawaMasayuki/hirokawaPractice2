<?php
try {
    $dbh = new PDO('mysql:host=localhost;dbname=sakaedb;charset=utf8', 'root', 'rY6-:rT8_xl3');
    foreach($dbh->query('SELECT * from staffs') as $row) {
        print_r($row);
    }
    $dbh = null;
} catch (PDOException $e) {
    print "エラー!: " . $e->getMessage()."<br/>";
    die();
}
