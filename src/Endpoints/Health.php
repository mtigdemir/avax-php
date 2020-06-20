<?php

namespace AVA\Endpoints;

class Health extends AbstractEndpoint
{
    protected $endPoint = "/ext/health";

    public function getLiveness()
    {
        $result = $this->client->apiCall($this->endPoint, "health.getLiveness");

        return $result->checks;
    }

    public function check():bool
    {
        $result = $this->client->apiCall($this->endPoint, "health.getLiveness");

        return $result->healthy;
    }
}
