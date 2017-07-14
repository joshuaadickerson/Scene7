<?php

namespace Scene7\Helpers;

class MediaQueries extends \ArrayIterator
{
    /**
     * @param string $query
     * @param array $commands
     * @return $this
     */
    public function addQuery($query, array $commands)
    {
        $this->offsetSet($query, $commands);
        return $this;
    }

    /**
     * @param string $query
     * @return $this
     */
    public function removeQuery($query)
    {
        $this->offsetUnset($query);
        return $this;
    }
}