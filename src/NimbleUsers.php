<?php

namespace Nimble;

use Http\Client\Exception;
use stdClass;

class NimbleUsers extends NimbleResource
{
    /**
     * Returns authenticated user information
     *
     * @see    https://nimble.readthedocs.io/en/latest/userinfo/
     * @return stdClass
     * @throws Exception
     */
    public function myself()
    {
        return $this->client->get('myself');
    }

}
