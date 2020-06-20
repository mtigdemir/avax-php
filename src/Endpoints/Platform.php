<?php

namespace AVA\Endpoints;

class Platform extends AbstractEndpoint
{
    protected $endPoint = "/ext/P";

    /**
     * Create P-Chain Account
     *
     * @param string $username
     * @param string $password
     * @param string $privateKey
     * @return string New Address
     */
    public function createAccount(string $username, string $password, string $privateKey = null):string
    {
        $parameters = [
            "username" => $username,
            "password" => $password
        ];

        if (isset($privateKey)) {
            $parameters["privateKey"] = $privateKey;
        }

        $result = $this->client->apiCall($this->endPoint, "platform.createAccount", $parameters);
        return $result->address;
    }

    /**
     * Complete a transfer of AVA from the X-Chain to the P-Chain
     *
     * @param string $username
     * @param string $password
     * @param string $to
     * @param integer $payerNonce
     * @return string TransactionID
     */
    public function importAVA(string $username, string $password, string $to, int $payerNonce = 1):string
    {
        $result = $this->client->apiCall($this->endPoint, "platform.importAVA", [
            "username" => $username,
            "password" => $password,
            "payerNonce" => $payerNonce,
            "to" => $to
        ]);

        return $result->tx;
    }

    /**
     * Issue a transaction to the P-Chain
     *
     * @param string $transaction
     * @return string TransactionID
     */
    public function issueTransaction(string $transaction):string
    {
        $result = $this->client->apiCall($this->endPoint, "platform.issueTx", [
            "tx" => $transaction
        ]);

        return $result->txID;
    }

    /**
     * An account is identified by an address
     *
     * @param string $address
     */
    public function getAccount(string $address)
    {
        $result = $this->client->apiCall($this->endPoint, "platform.getAccount", [
            "address" => $address
        ]);

        return $result;
    }

    /**
     * List the validators in the pending validator set of the specified Subnet
     *
     * @return array
     */
    public function getPendingValidators():array
    {
        $result = $this->client->apiCall($this->endPoint, "platform.getPendingValidators");
        return $result->validators;
    }
}
