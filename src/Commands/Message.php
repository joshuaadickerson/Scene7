<?php

namespace Scene7\Commands;

trait Message
{
    public function setMessage($message)
    {
        return $this->addCommand('message', $message);
    }
}