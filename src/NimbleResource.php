<?php


namespace Nimble;

abstract class NimbleResource
{
    /**
     * @var NimbleClient
     */
    protected $client;

    /**
     * IntercomResource constructor.
     *
     * @param NimbleClient $client
     */
    public function __construct(NimbleClient $client)
    {
        $this->client = $client;
    }
}