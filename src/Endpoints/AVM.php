<?php

namespace AVA\Endpoints;

class AVM extends AbstractEndpoint
{
   protected $endPoint = "/ext/bc/X";

    /**
     * Create a new address controlled by the given user.
     *
     * @param string $username
     * @param string $password
     * @return string Address 
     */
    public function createAddress(string $username, string $password):string
    {
        $result = $this->client->apiCall($this->endPoint, "avm.createAddress", [
            "username" => $username,
            "password" => $password
        ]);

        return $result->address;
    }

    /**
     * List addresses controlled by the given user.
     *
     * @param string $username
     * @param string $password
     * @return array Address List
     */
    public function listAddresses(string $username, string $password):array
    {
        $result = $this->client->apiCall($this->endPoint, "avm.listAddresses",[
            "username" => $username,
            "password" => $password
        ]);

        return $result->addresses;
    }

    public function transactionStatus(string $transactionId):string
    {
        $result = $this->client->apiCall($this->endPoint, "avm.getTxStatus", [
            "txID" => $transactionId
        ]);

        return $result->status;
    }

    /**
     * Send a quantity of an asset to an address.
     *
     * @param string $username
     * @param string $password
     * @param string $receiverAddress
     * @param int $amount
     * @param string $assetID
     * @return string transactionID
     */
    public function send(string $username, string $password, string $receiverAddress, int $amount, $assetID = "AVA"):string
    {
        $result = $this->client->apiCall($this->endPoint, "avm.send", [
            "amount" => $amount,
            "assetID" => $assetID,
            "username" => $username,
            "password" => $password,
            "to" => $receiverAddress
        ]);  

        return $result->txID;
    }

    public function getBalance(string $address, string $assetID = "AVA")
    {
        $result = $this->client->apiCall($this->endPoint, "avm.getBalance", [
            "address" => $address,
            "assetID" => $assetID
        ]);

        return $result;
    }
}
