<?php

namespace Tests\AVA\Endpoints;

class HealthTest extends BaseEndpointTest
{
    public function testHealthLiveness()
    {
        $this->mockApiCall('health.getLiveness.json');
        $result = $this->apiClient->health->getLiveness();

        $this->assertNotEmpty($result);
        // TODO: More Assertion

        $this->assertEquals("health.getLiveness", $this->getLastRequest()->method);
    }

    public function testHealtchCheck()
    {
        $this->mockApiCall('health.getLiveness.json');

        $result = $this->apiClient->health->check();
        $this->assertTrue($result);
    }
}
