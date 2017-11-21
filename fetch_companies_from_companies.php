<?php

require 'functions.php';
require 'config.php';
$code = 200;
$response = [];


$sql = "SELECT companies.* FROM companies";

try {
    $statement = $pdo->prepare($sql);
    $statement->execute();
    $companies = $statement->fetchAll();

    foreach ($companies as $company) {
        $company_id = $company['id'];
        $company_name = $company['company_name'];
        $sqlUpdate = "UPDATE customers SET company_id='$company_id' WHERE customer_company='$company_name'";
        $pdo->exec($sqlUpdate);
        echo "Company ID <strong>$company_id</strong> added successfully.";
    }

} catch (PDOException $e) {
    echo $sql . "<br>" . $e->getMessage();
}

$conn = null;

($pdo);
