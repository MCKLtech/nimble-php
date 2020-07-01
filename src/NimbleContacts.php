<?php

namespace Nimble;

use Http\Client\Exception;
use stdClass;

class NimbleContacts extends NimbleResource
{

    /**
     * Lists Contacts
     *
     * @see    https://nimble.readthedocs.io/en/latest/contacts/basic/list/
     * @param  array $options
     * @return stdClass
     * @throws Exception
     */
    public function list(array $options = [])
    {
        return $this->client->get('contacts', $options);
    }

    /**
     * Lists Contacts IDs
     *
     * @see    https://nimble.readthedocs.io/en/latest/contacts/basic/list/
     * @param  array $options
     * @return stdClass
     * @throws Exception
     */
    public function listIDs(array $options = [])
    {
        return $this->client->get('contacts/ids', $options);
    }

    /**
     * Creates a Contact
     *
     * @see    https://nimble.readthedocs.io/en/latest/contacts/basic/create/#request
     * @param  array $options
     * @return stdClass
     * @throws Exception
     */
    public function create(array $options)
    {
        $options = array_merge($options, ['record_type' => 'person']);

        return $this->client->post('contact', $options);
    }

    /**
     * Gets a single contact based on the Nimble Contact ID.
     *
     * @see    https://nimble.readthedocs.io/en/latest/contacts/basic/details/#request
     * @param  string $id
     * @return stdClass
     * @throws Exception
     */
    public function get($id)
    {
        return $this->client->get('contact/' . $id);
    }

    /**
     * Updates a Contact.
     *
     * @see    https://nimble.readthedocs.io/en/latest/contacts/basic/update/#request
     * @param string $id
     * @param array $options
     * @param bool $replace
     * @return stdClass
     */
    public function update($id, array $options, $replace = false)
    {
        $path = $this->userPath($id);

        if($replace) {
            $path = $path.'?replace=1';
        }

        return $this->client->put($path, $options);
    }

    /**
     * Deletes a Contact.
     *
     * @see    https://nimble.readthedocs.io/en/latest/contacts/basic/delete/#simple-contacts-delete
     * @param string $id
     * @return stdClass
     */
    public function delete($id)
    {
        $path = $this->userPath($id);

        return $this->client->delete($path);
    }

    /**
     * Finds contacts by given params
     * Defaults to a search by email address
     *
     * @see    https://nimble.readthedocs.io/en/latest/contacts/basic/search/
     * @param string $value The value to search by e.g. An email address
     * @param string $field The value to search in e.g. email, phone, last name
     * @param bool $single Return a single result (Defaults to first result on the first page)
     * @param array $addOptions Additional parameters e.g. Page, Limit
     * @return stdClass
     */
    public function findBy($value, $field = 'email', $single = true, $addOptions = [])
    {
        $query = [];

        $query[$field] = ['is' => $value];

        $options = ['query' => json_encode($query)];

        /* Limit to first and single result */

        if($single) {

            $options = array_merge(
                $options,
                [
                    'per_page' => 1,
                    'limit' => 1
                ]
            );

        }

        $options = array_merge($options, $addOptions);

        $result =  $this->client->get('contacts', $options);

        if($single && isset($result->resources)) {

            $result = reset($result->resources);
        }

        return $result;
    }

    /**
     * @param string $id
     * @return string
     */
    public function userPath(string $id)
    {
        return 'contacts/' . $id;
    }
}
