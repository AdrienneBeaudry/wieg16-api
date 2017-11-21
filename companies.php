<?php

require 'functions.php';

$code = 200;

$companies = file_get_contents('customers.json');

header("content-type: application/json", true, $code);
echo $companies;



