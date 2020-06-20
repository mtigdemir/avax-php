<?php

namespace Tests\AVA\Endpoints;

class AVMTest extends BaseEndpointTest
{
    public $asset = "2sdnziCz37Jov3QSNMXcFRGFJ1tgauaj6L7qfk7yUcRPfQMC79";

    public $address = "X-EKpEPX56YA1dsaHBsW8X5nGqNSwJ7JrWH";

    public $transactionId = "2QouvFWUbjuySRxeX5xMbNCuAaKWfbk5FeEa2JmoF85RKLk2dD";

    public function testCreateAddress()
    {
        $this->mockApiCall("createAddress.json");

        $result = $this->apiClient->xchain->createAddress("username", "password");
        $this->assertEquals($this->address, $result);
        $this->assertEquals("avm.createAddress", $this->getLastRequest()->method);
    }

    public function testListAddress()
    {
        $this->mockApiCall("xchain.addressList.json");

        $result = $this->apiClient->xchain->listAddresses("username", "password");
        $this->assertIsArray($result);
        $this->assertEquals("avm.listAddresses", $this->getLastRequest()->method);
    }

    public function testSend()
    {
        $this->mockApiCall("send.json");

        $result = $this->apiClient->xchain->send("username", "password", $this->address, 1000);

        $this->assertInternalType("string", $result);
        $this->assertNotEmpty($result);
        $this->assertEquals("avm.send", $this->getLastRequest()->method);
    }

    public function testTransactionStatus()
    {
        $this->mockApiCall("transactionStatus.json");

        $result = $this->apiClient->xchain->transactionStatus($this->transactionId);
        $this->assertEquals("Accepted", $result);
        $this->assertEquals("avm.getTxStatus", $this->getLastRequest()->method);
    }

    public function testGetBalance()
    {
        $this->mockApiCall("xchain.getBalance.json");

        $result = $this->apiClient->xchain->getBalance($this->address, $this->asset);

        $this->assertEquals("299999999999900", $result->balance);
        $this->assertEquals("avm.getBalance", $this->getLastRequest()->method);
    }
}
