<?php

namespace AVA;

use AVA\Endpoints\{Admin, AVM, Health, KeyStore, Platform};
use AVA\Exceptions\ApiException;
use GuzzleHttp\ClientInterface;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;
use GuzzleHttp\Psr7\Request;
use Psr\Http\Message\ResponseInterface;
use GuzzleHttp\Exception\ClientException;

class AVAClient
{
    /**
     * @var ClientInterface
     */
    protected $httpClient;

    /**
     * KeyStore End Point
     *
     * @var KeyStore
     */
    public $keyStore;

    /**
     * Health End Point
     *
     * @var Health
     */
    public $health;

    /**
     * X-Chain End Point (AVM)
     *
     * @var AVM
     */
    public $xchain;

    /**
     * P-Chain End Point (Platform)
     *
     * @var Platform
     */
    public $pchain;

    /**
     * Admin End Point
     *
     * @var Admin
     */
    public $admin;

    /**
     * @param ClientInterface $httpClient
     *
     */
    public function __construct(ClientInterface $httpClient = null)
    {
        $this->httpClient = $httpClient ?
            $httpClient : new Client([
            'base_uri' => '127.0.0.1:9650',
            'Accept' => 'application/json'
        ]);

        $this->initializeEndPoints();
    }

    private function initializeEndPoints(){
        $this->keyStore = new KeyStore($this);
        $this->health = new Health($this);
        $this->xchain = new AVM($this);
        $this->pchain = new Platform($this);
        $this->admin = new Admin($this);
    }

    public function apiCall($endPoint, $method, $params = [])
    {
        $httpBody = [];
        $httpBody['jsonrpc'] = "2.0";
        $httpBody['id'] = 1;
        $httpBody['method'] = $method;
        $httpBody['params'] = $params;

        try {
            $request = new Request('POST', $endPoint, [
                'Content-type' => 'application/json'
            ], json_encode($httpBody));

            $response = $this->httpClient->send($request);
        } catch (ClientException $exception){
            throw new ApiException($exception->getMessage());
        } catch (GuzzleException $exception) {
            throw new ApiException($exception->getMessage());
        }

        return $this->parseResponseBody($response);
    }

    private function parseResponseBody(ResponseInterface $responseBody)
    {
        $body = (string) $responseBody->getBody();
        $object = @json_decode($body);
        
        if (isset($object->error)) {
            throw new ApiException($object->error->message);
        }
        return $object->result;
    }
}
