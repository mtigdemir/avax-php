<?php

namespace Tests\AVA\Endpoints;

class AdminTest extends BaseEndpointTest
{
    public function testGetNodeID()
    {
        $this->mockApiCall("admin.nodeID.json");

        $result = $this->apiClient->admin->nodeID();
        $this->assertNotEmpty($result);
        $this->assertEquals("admin.getNodeID", $this->getLastRequest()->method);
    }

    public function testGetNodeVersion()
    {
        $this->mockApiCall("admin.nodeVersion.json");

        $result = $this->apiClient->admin->nodeVersion();
        $this->assertEquals("avalanche/0.5.5", $result);
        $this->assertEquals("admin.getNodeVersion", $this->getLastRequest()->method);
    }

    public function testGetNetworkName()
    {
        $this->mockApiCall("admin.network.json");

        $result = $this->apiClient->admin->networkName();

        $this->assertEquals("denali", $result);
    }
}