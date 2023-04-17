<?php

use PHPUnit\Framework\TestCase;

class DisbursePaymentTest extends TestCase
{
    public function testZamtelChargeRequest()
    {
        // Replace with the actual values for msisdn and amount
        $msisdn = '1234567890';
        $amount = '1654';

        $controller = new DisbursePaymentTest();
        $response = $controller->zamtelChargeRequest($msisdn, $amount);
        $responseDecoded = json_decode($response, true);

        $this->assertTrue($responseDecoded['success']);
        $this->assertEquals(0, $responseDecoded['data']['StatusCode']);
        $this->assertEquals('Successfully posted a transaction', $responseDecoded['message']);
    }
}
