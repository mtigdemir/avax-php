<?php

namespace Tests\AVA\Endpoints;

class PlatformTest extends BaseEndpointTest
{
    public function testCreateAddress()
    {
        $this->mockApiCall("createAddress.json");

        $result = $this->apiClient->pchain->createAccount("username", "password");
        $this->assertNotEmpty($result);

        $this->assertEquals("platform.createAccount", $this->getLastRequest()->method);
    }

    public function testImportAVA()
    {
        $this->mockApiCall("platform.importAVA.json");

        $result = $this->apiClient->pchain->importAVA("username", "password", "pchain-address");
        $this->assertNotEmpty($result);
        $this->assertInternalType("string", $result);

        $this->assertEquals("platform.importAVA", $this->getLastRequest()->method);
    }

    public function testIssueTransaction()
    {
        $this->mockApiCall("platform.issueTransaction.json");

        $result = $this->apiClient->pchain->issueTransaction("111Bit5JNASbJyTLrd2kWkYRoc96swEWoWdmEhuGAFK3rC");
        $this->assertNotEmpty($result);
        $this->assertInternalType("string", $result);

        $this->assertEquals("platform.issueTx", $this->getLastRequest()->method);
    }

    public function testGetAccount()
    {
        $this->mockApiCall("platform.getAccount.json");

        $result = $this->apiClient->pchain->getAccount("NcbCRXGMpHxukVmT8sirZcDnCLh1ykWp4");

        $this->assertEquals("NcbCRXGMpHxukVmT8sirZcDnCLh1ykWp4", $result->address);
        $this->assertEquals(0, $result->balance);
        $this->assertEquals(0, $result->nonce);
    }

    public function testGetPendingValidators()
    {
        $this->mockApiCall("platform.getPendingValidators.json");

        $result = $this->apiClient->pchain->getPendingValidators();
        $this->assertIsArray($result);
        $this->assertCount(1, $result);
    }
}
