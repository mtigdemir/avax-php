<?php

namespace Tests\AVA\Endpoints;

use AVA\AVAClient;
use GuzzleHttp\Client;
use GuzzleHttp\Psr7\Response;
use GuzzleHttp\Handler\MockHandler;
use GuzzleHttp\HandlerStack;

abstract class BaseEndpointTest extends \PHPUnit\Framework\TestCase
{
    /**
     * @var AVAClient
     */
    protected $apiClient;

    /**
     *
     * @var MockHandler
     */
    protected $mockHandler;

    public function setUp()
    {
        $this->mockHandler = new MockHandler();
        $handlerStack = HandlerStack::create($this->mockHandler);
        $client = new Client(['handler' => $handlerStack]);

        $this->apiClient = new AVAClient($client);
    }

    protected function mockApiCall($mockResponseFile, $status = 200)
    {
        $path = sprintf('%s/../Fixtures/%s', __DIR__, $mockResponseFile);

        $mockResponse = file_get_contents($path);
        $response = new Response($status, [], $mockResponse);
        $this->mockHandler->append($response);
    }

    protected function getLastRequest()
    {
        $request = $this->mockHandler->getLastRequest();

        return json_decode($request->getBody()->getContents());
    }
}
