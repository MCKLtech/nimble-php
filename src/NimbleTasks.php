<?php


namespace Nimble;

use Http\Client\Exception;
use stdClass;

class NimbleTasks extends NimbleResource
{
    /**
     * Creates a Task
     *
     * @see    https://nimble.readthedocs.io/en/latest/activities/tasks/create/#request
     * @param  array $options
     * @return stdClass
     * @throws Exception
     */
    public function create(array $options)
    {
        return $this->client->post('activities/task', $options);
    }

}
