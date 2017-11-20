<?php

require 'functions.php';
require 'config.php';
$code = 200;
$response = [];

if (isset($_GET['customer_id'])) {
    $get_customer_id = $_GET['customer_id'];
    $sql = "SELECT customers.* FROM customers WHERE id=$get_customer_id";
} else {
    $sql = "SELECT customers.* FROM customers";
}

try {
    $statement = $pdo->prepare($sql);
    $statement->execute();
    $customers = $statement->fetchAll();

    if (count($customers) > 0) {
        $address_stmnt = $pdo->prepare("SELECT * FROM customer_addresses ORDER BY customer_id");
        $address_stmnt->execute();
        $addresses = $address_stmnt->fetchAll();

        if (isset($_GET['address']) and isset($_GET['customer_id'])) {

        } else {

        }

        foreach ($customers as $key => $customer) {
            // WHY function /use syntax here. Don't get it...
            $address = array_filter($addresses, function ($address) use ($customer) {
                return ($address['customer_id'] == $customer['id']);
            });

            // Note: the function array_filter will retain the original index for each values that "passes the filter"
            // or passes the test. In order to reset the index to 0, 1, 2, 3 we will need to use the function array_values.
            // $address = array_values($address);

            //WHY the below? Longer then the solution I would have done underneath??
            $address = (count($address) > 0) ? array_shift($address) : null;
            if ($address != null) {
                // This embeds the child child in the last key of the main array
                $customers[$key]['address'] = $address;
            }

            if (count($address) > 0) {
                $customers[$key]['address'] = array_shift($address);
            }

            /*
*/
        }
        $response = $customers;
    } else {
        $code = 404;
        $response = ['message' => 'Customer not found'];
    }

    header("content-type: application/json", true, $code);
    echo json_encode($response);

} catch (PDOException $e) {
    echo $sql . "<br>" . $e->getMessage();
}

$conn = null;

($pdo);