<?php

/**
 * @author Thulani Rex
 * @Desc Zamtel Request to Pay (C2B)
 **/

require_once 'vendor/autoload.php';

// Get the request method and URI
$requestMethod = $_SERVER['REQUEST_METHOD'];
$requestUri = $_SERVER['REQUEST_URI'];

// Remove query string from request URI
if (false !== $pos = strpos($requestUri, '?')) {
    $requestUri = substr($requestUri, 0, $pos);
}

// Remove trailing slashes from request URI
$requestUri = rtrim($requestUri, '/');

// Instantiate the desired classes
$requestPayment = new CollectPayment();
$payCustomer = new DisbursePayment();

// Define routes
switch ($requestUri) {
    case '/c2b-charge':
        $response = $requestPayment->zamtelChargeRequest($_GET['msisdn'], $_GET['amount']);
        break;
    case '/b2c-charge':
        $response = $payCustomer->zamtelChargeRequest($_GET['msisdn'], $_GET['amount']);
        break;
    default:
        http_response_code(404);
        $response = json_encode(['error' => 'Route not found']);
}

header('Content-Type: application/json');
echo $response;
