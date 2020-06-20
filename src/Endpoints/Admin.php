<?php

namespace AVA\Endpoints;

class Admin extends AbstractEndpoint
{
    protected $endPoint = "/ext/admin";

    /**
     * Get the ID of this node.
     *
     * @return string Node ID
     */
    public function nodeID():string
    {
        $result = $this->client->apiCall($this->endPoint, "admin.getNodeID");
        return $result->nodeID;
    }

    /**
     * Get Node Version
     *
     * @return string Node Version
     */
    public function nodeVersion():string
    {
        $result = $this->client->apiCall($this->endPoint, "admin.getNodeVersion");
        return $result->version;
    }

    /**
     * Get the name of the network this node is running on
     *
     * @return string Network Name
     */
    public function networkName():string
    {
        $result = $this->client->apiCall($this->endPoint, "admin.getNetworkName");

        return $result->networkName;
    }
}
