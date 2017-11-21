<?php

require 'functions.php';
require 'config.php';
$code = 200;
$response = [];
$get_customer_id = isset($_GET['customer_id']) ? $_GET['customer_id'] : null;
$show_address_only = isset($_GET['address']) ? $_GET['address'] : null;
$get_company_id = isset($_GET['company_id']) ? $_GET['company_id'] : null;

if (isset($_GET['customer_id'])) {
    $sql = "SELECT customers.* FROM customers WHERE id=$get_customer_id";
} elseif (isset($_GET['company_id'])) {
    $sql = "SELECT customers.* FROM customers WHERE company_id=$get_company_id";
} else {
    $sql = "SELECT customers.* FROM customers";
}

try {
    $statement = $pdo->prepare($sql);
    $statement->execute();
    $customers = $statement->fetchAll();


    if (count($customers) > 0) {

        if (!isset($_GET['company_id'])) {
            $address_stmnt = $pdo->prepare("SELECT * FROM customer_addresses ORDER BY customer_id");
            $address_stmnt->execute();
            $addresses = $address_stmnt->fetchAll();

            foreach ($customers as $key => $customer) {
                // array_filter function parses through the array and only keeps the items that pass "the test"
                // i.e. where the callback function returns true.
                // it will return a new array with only the values that "passed"
                // The syntax below uses an anonymous function, meaning that we are defining the function "$address"
                // inside the curly brackets and we are also passing along with the function
                // a variable found in the parent's scope with the particular syntax (use) needed for that.
                $address = array_filter($addresses, function ($address) use ($customer) {
                    return ($address['customer_id'] == $customer['id']);
                });
                $customers[$key]['address'] = $address;

                if ($show_address_only != null) {
                    if (count($address) > 0) {
                        $response = $address;
                    } else {
                        $code = 404;
                        $response = ['message' => 'Address not found'];
                    }
                } else {
                    $response = $customers;
                }
            }
        }

        else {
            $response = $customers;
        }


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
