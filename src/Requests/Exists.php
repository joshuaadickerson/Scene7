<?php

namespace Scene7\Requests;

use Scene7\Commands;
use Scene7\Definitions\ResponseTypes;

class Exists extends AbstractRequest
{
    use Commands\ResponseType,
        Commands\Id;

    /**
     * @param string $baseUrl
     * @param string $file
     */
    public function __construct($baseUrl, $file)
    {
        $this->setBaseUrl($baseUrl);
        $this->file = $file;
    }

    public function getRequestType()
    {
        return 'exists';
    }

    public function getAllowedResponseTypes()
    {
        return [
            ResponseTypes::TEXT,
            ResponseTypes::JAVASCRIPT,
            ResponseTypes::XML,
            ResponseTypes::JSON,
        ];
    }
}