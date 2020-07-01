<?php


namespace Nimble;


class NimbleCompanies extends NimbleResource
{

    /**
     * Returns authenticated company user information
     *
     * @see    https://nimble.readthedocs.io/en/latest/company/users/list/
     * @param array $options
     * @return \stdClass
     */
    public function list(array $options = [])
    {
        return $this->client->get('company/users', $options);
    }
}
