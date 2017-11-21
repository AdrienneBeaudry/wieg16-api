<?php

require 'functions.php';
require 'config.php';
$code = 200;
$response = [];


$sql = "SELECT customers.* FROM customers";

try {
    $statement = $pdo->prepare($sql);
    $statement->execute();
    $customers = $statement->fetchAll();
    $companies = [];

    foreach ($customers as $customer) {
        $companies[] = $customer['customer_company'];
    }

    $companies = array_unique($companies);

    /*
    foreach ($companies as $company) {
        $sqlCompany = "INSERT INTO companies(company_name) VALUES ('$company')";
        $pdo->exec($sqlCompany);
        echo "New company record created successfully for customer ID <strong>$company</strong>";
    }
    */

} catch (PDOException $e) {
    echo $sql . "<br>" . $e->getMessage();
}

$conn = null;

($pdo);
