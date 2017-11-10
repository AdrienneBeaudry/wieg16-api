<?php

require 'functions.php';
require 'config.php';

header("content-type: application/json");

$sql = "SELECT customers.* FROM customers";

try {
    $statement = $pdo->prepare($sql);
    $statement->execute();
    $customers = $statement->fetchAll(PDO::FETCH_ASSOC);
    $address_stmnt = $pdo->prepare("SELECT * FROM customer_addresses ORDER BY customer_id");
    $address_stmnt->execute();
    $addresses = $address_stmnt->fetchAll(PDO::FETCH_ASSOC);
    foreach ($customers as $key => $customer) {
        $address = array_filter($addresses, function($address) use ($customer) {
            return ($address['customer_id'] == $customer['id']);
        });
        $address = (count($address) > 0) ? array_shift($address) : null;
        // array_pop
        if ($address != null) {
            $customers[$key]['address'] = $address;
        }
    }
    echo json_encode($customers);
}

catch (PDOException $e) {
    echo $sql . "<br>" . $e->getMessage();
}

$conn = null;

($pdo);