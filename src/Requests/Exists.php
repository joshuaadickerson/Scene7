<?php

namespace Scene7\Requests;

use Scene7\Commands;

class Exists extends AbstractRequest
{
    use Commands\ResponseType,
        Commands\Id;

    protected $responseType;

    public function __construct($baseUrl, $file)
    {
        $this->setBaseUrl($baseUrl);
        $this->file = $file;
        $this->addCommand(['req' => $this->getRequestType()]);
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