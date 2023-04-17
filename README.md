### Zamtel Mobile Money API Integration

This repository contains PHP classes for integrating with the Zamtel Mobile Money API. It includes two classes: CollectPayment and DisbursePayment. Both classes provide methods for making charge requests to the API, with the DisbursePayment class also supporting business-to-customer transactions.


### Getting Started

Prerequisites

    PHP 7.2 or higher
    Composer

# Installation

## Clone the repository:
git clone https://github.com/thulanirex/zamtel-mobile-money-php-sdk

## Install the required dependencies:
cd zamtel-mobile-money
composer install

## Set up your environment variables:

Create a .env file in the project's root directory and define the necessary environment variables:

ZAMPAY_THIRD_PARTY_ID=your_third_party_id
ZAMPAY_PASSWORD=your_password
ZAMPAY_SHORTCODE=your_shortcode
ZAMPAY_IDENTIFIER=your_identifier
ZAMPAY_CREDENTIAL=your_credential

## Usage
# To use the CollectPayment class:

$collectPayment = new CollectPayment();
$response = $collectPayment->zamtelChargeRequest($msisdn, $amount);

## To use the DisbursePayment class:
$disburse = new DisbursePayment();
$response = $disburse->zamtelChargeRequest($msisdn, $amount);

Replace $msisdn and $amount with the actual values for the mobile number and the transaction amount.

## Running the Project Locally as an API

This project can be set up as a simple REST API without using any framework. A basic router is included to define routes for both the CollectPayment and DisbursePayment classes. Follow these steps to run it locally:

    1. I have created a file named api.php in the project's root directory. This file will handle API requests and routing.

    2. Open a terminal or command prompt and navigate to the project's root directory. Run the following command to start the built-in web server:

    php -S localhost:8000 api.php

   The API is now running on http://localhost:8000. You can make GET requests to the following endpoints:

    /zamtel-charge for the CollectPayment class, with the msisdn and amount parameters, for example:
   
   http://localhost:8000/c2b-charge?msisdn=26095xxxxxxx&amount=1654

   /b2c-charge for the DisbursePayment class, with the msisdn and amount parameters, for example:

   http://localhost:8000/b2c-charge?msisdn=26095xxxxxxx&amount=1


## Running Tests

This project includes PHPUnit tests for the DisbursePayment and CollectPayment classes. Run the tests with the following command:

./vendor/bin/phpunit

Keep in mind that this setup is only intended for local testing and development. For production use, consider using a more robust web server like Apache or Nginx.

## Support and Help

For support or help, please contact the developer:

Name: Rex Thulani
Email: thulanirex@gmail.com

## License

This project is licensed under the MIT License.