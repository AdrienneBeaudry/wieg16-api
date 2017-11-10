<?php

require 'functions.php';
require 'config.php';

header("content-type: application/json");

if (isset($_GET['customer_id'])) {
    $get_customer_id = $_GET['customer_id'];
    $sql = "SELECT customers.* FROM customers WHERE id=$get_customer_id";
} else {
    $sql = "SELECT customers.* FROM customers";
}

try {
    $statement = $pdo->prepare($sql);
    $statement->execute();
    $customers = $statement->fetchAll(PDO::FETCH_ASSOC);

    if (count($customers)>0) {
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
    else {
        header("HTTP/1.0 404 Not Found");
        echo "{\"message\": \"Customer not found\"}";
    }

}

catch (PDOException $e) {
    echo $sql . "<br>" . $e->getMessage();
}

$conn = null;

($pdo);