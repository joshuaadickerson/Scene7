<?php

namespace Scene7\Commands;

trait ResponseType
{
    protected function setResponseType($responseType)
    {
        if (!in_array($responseType, $this->getAllowedResponseTypes())) {
            throw new \InvalidArgumentException('Invalid response type');
        }

        $this->addCommand(['req' => $this->getRequestType() . ',' . $responseType]);
        return $this;
    }
}