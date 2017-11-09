<?php

require 'functions.php';
require 'connection.php';

header("content-type: application/json");

try {
    $pdo = new PDO("mysql:dbname=$dbname;host=$servername", $username, $password);
    // set the PDO error mode to exception
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $sql = "SELECT * FROM customers FULL OUTER JOIN customer_addresses ON customers.id=customer_addresses.customer_id";
    $pdo->exec($sql);
}

catch (PDOException $e) {
    echo $sqlCustomer . "<br>" . $e->getMessage();
    echo $sqlAddress . "<br>" . $e->getMessage();
}

$conn = null;