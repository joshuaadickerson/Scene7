<?php

namespace Scene7\Commands;

trait ResponseType
{
    protected function setResponseType($responseType)
    {
        if (!in_array($responseType, self::ALLOWED_RESPONSE_TYPES)) {
            throw new \InvalidArgumentException('Invalid response type');
        }

        $this->addCommand(['req' => $this->getRequestType() . ',' . $responseType]);
        return $this;
    }
}