<?php

namespace Scene7\Helpers;

class MediaQueries extends \ArrayIterator
{
    public function addQuery($query, array $commands)
    {
        $this->offsetSet($query, $commands);
        return $this;
    }

    public function removeQuery($query)
    {
        $this->offsetUnset($query);
        return $this;
    }
}