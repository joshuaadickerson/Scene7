<?php

namespace Scene7\Commands\Layer;

trait Source
{
    // @todo I don't understand the documentation for this so for now, it's just a string
    public function setSource($source)
    {
        return $this->addCommand(['source' => $source]);
    }
}