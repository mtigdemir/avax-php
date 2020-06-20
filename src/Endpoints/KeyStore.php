<?php

namespace AVA\Endpoints;

class KeyStore extends AbstractEndpoint
{
    protected $endPoint = "/ext/keystore";

    /**
     * Create a new user with the specified username and password.
     *
     * @return bool
     */
    public function createUser(string $username, string $password):bool
    {
        $result = $this->client->apiCall($this->endPoint, 'keystore.createUser', [
            "username" => $username,
            "password" => $password
        ]);
        
        return (bool)$result->success;
    }

    /**
     * Delete a user
     *
     * @param string $username
     * @param string $password
     * @return bool
     */
    public function deleteUser(string $username, string $password):bool
    {
        $result = $this->client->apiCall($this->endPoint, 'keystore.deleteUser', [
            "username" => $username,
            "password" => $password
        ]);

        return (bool)$result->success;
    }

    /**
     * List the users in this keystore
     *
     * @return array
     */
    public function listUsers()
    {
        $result = $this->client->apiCall($this->endPoint, 'keystore.listUsers');
        return $result->users;
    }

    /**
     * Export User
     *
     * @param string $username
     * @param string $password
     * @return string Export Key
     */
    public function exportUser(string $username, string $password):string
    {
        $result = $this->client->apiCall($this->endPoint, 'keystore.exportUser', [
            "username" => $username,
            "password" => $password
        ]);

        return $result->user;
    }

    /**
     * Import User
     *
     * @param string $username
     * @param string $password
     * @param string $userExport
     * @return boolean
     */
    public function importUser(string $username, string $password, string $userExport):bool
    {
        $result = $this->client->apiCall($this->endPoint, 'keystore.importUser', [
            "username" => $username,
            "password" => $password,
            "user" => $userExport
        ]);

        return (bool)$result->success;
    }
}
