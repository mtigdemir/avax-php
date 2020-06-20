<?php

namespace Tests\AVA;

use AVA\AVAClient;
use AVA\Exceptions\ApiException;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\RequestException;
use GuzzleHttp\Handler\MockHandler;
use GuzzleHttp\HandlerStack;
use GuzzleHttp\Psr7\Request;
use GuzzleHttp\Psr7\Response;


class AVAClientTest extends TestCase
{
    /**
     * @var AVAClient
     */
    protected $ava;

    /**
     *
     * @var MockHandler
     */
    protected $mockHandler;

    public function setUp()
    {
        parent::setUp();
        $this->mockHandler = new MockHandler();
        $handlerStack = HandlerStack::create($this->mockHandler);
        $client = new Client(['handler' => $handlerStack]);

        $this->ava = new AVAClient($client);
    }

    /**
     * Json RPC Error Response
     * (https://docs.ava.network/v1.0/en/api/issuing-api-calls/#json-rpc-error-response)
     */
    public function test_ava_errors_should_throw_exception()
    {
        $responseBody = [
            "jsonrpc" => "2.0",
            "error" => [
                "code" => -32600,
                "message" => "Some error message",
                "data" => []
            ]
        ];

        $this->mockHandler->append(new Response(200, [], json_encode($responseBody)));
        $this->expectExceptionMessage("Some error message");
        $this->ava->apiCall("testing", "testmtehod");
    }

    public function test_not_found_end_point_error()
    {
        $requestException = new RequestException('404 page not found', new Request('GET', 'test'), new Response(404, [], '404 page not found'));
        $this->mockHandler->append($requestException);

        $this->expectException(ApiException::class);
        $this->expectExceptionMessage("404 page not found");
        $this->ava->apiCall("testing", "testmethod");
    }
}