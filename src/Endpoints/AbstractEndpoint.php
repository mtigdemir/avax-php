<?php

namespace AVA\Endpoints;

use AVA\AVAClient;
use Exception;

abstract class AbstractEndpoint
{
    /**
     * End Point must be defined by extended class
     *
     * @var string
     */
    protected $endPoint = "";

    /**
     * AVAClient
     *
     * @var AVAClient
     */
    protected $client;

    public function __construct(AVAClient $avaClient)
    {
        $this->client = $avaClient;
        
        if (empty($this->endPoint)) {
            throw new Exception("End Point can not be empty");
        }
    }
}
