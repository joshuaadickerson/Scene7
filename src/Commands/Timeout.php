<?php

namespace Scene7\Commands;

trait Timeout
{
    // from saveToFile req type
    public function setTimeout($milliseconds)
    {
        $this->addCommand(array('timeout' => (int) $milliseconds));
        return $this;
    }
}