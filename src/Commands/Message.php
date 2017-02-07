<?php

namespace Scene7\Commands;

use Scene7\Requests\AbstractRequest;

trait Message
{
    /**
     * @param string $message
     * @return AbstractRequest
     */
    public function setMessage($message)
    {
        return $this->addCommand('message', $message);
    }
}