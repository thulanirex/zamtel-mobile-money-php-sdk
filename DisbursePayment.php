<?php

require 'vendor/autoload.php';


/**
 * @author Thulani Rex
 * @Desc Zamtel Request to Pay Customer(B2C)
 **/

$dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
$dotenv->load();


class DisbursePayment {
    protected $client;

    public function __construct()
    {
        $this->client = new GuzzleHttp\Client();
    }

    public function zamtelPayCustomer($msisdn, $amount) {
        $thirdPartyId = getenv('ZAMPAY_THIRD_PARTY_ID');
        $password = getenv('ZAMPAY_PASSWORD');
        $shortcode = getenv('ZAMPAY_SHORTCODE');
        $identifier = getenv('ZAMPAY_IDENTIFIER');
        $credential = getenv('ZAMPAY_CREDENTIAL');
        $conversationId = md5(uniqid(rand(), true));

        $response = $this->client->request('GET', 'https://apps.zamtel.co.zm/ZampayRestProd/B2CReq', [
            'query' => [
                'ThirdPartyID' => $thirdPartyId,
                'Password' => $password,
                'Amount' => $amount,
                'Msisdn' => $msisdn,
                'Shortcode' => $shortcode,
                'identifier' => $identifier,
                'credential' => $credential,
                'ConversationId' => $conversationId
            ]
        ]);

        $responseBody = json_decode($response->getBody(), true);

        if (isset($responseBody['StatusCode']) && $responseBody['StatusCode'] == 0) {
            return $this->sendResponse($responseBody, 'Successfully posted a transaction');
        } else {
            return $this->sendResponse($responseBody, 'Transaction failed', false);
        }
    }

    public function sendResponse($data, $message, $success = true) {
        $response = [
            'success' => $success,
            'data' => $data,
            'message' => $message
        ];

        return json_encode($response);
    }
}

if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    if (isset($_GET['msisdn']) && isset($_GET['amount'])) {
        $msisdn = $_GET['msisdn'];
        $amount = $_GET['amount'];

        $controller = new DisbursePayment();
        $response = $controller->zamtelPayCustomer($msisdn, $amount);

        header('Content-Type: application/json');
        echo $response;
    } else {
        http_response_code(400);
        echo json_encode(['success' => false, 'message' => 'msisdn and amount are required']);
    }
} else {
    http_response_code(405);
    echo json_encode(['success' => false, 'message' => 'Method not allowed']);
}
