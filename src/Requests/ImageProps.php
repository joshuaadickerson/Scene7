<?php

namespace Scene7\Requests;

use Scene7\Commands;
use Scene7\Definitions\ResponseTypes;

class ImageProps extends AbstractRequest
{
    use Commands\ResponseType,
        Commands\Id;

    public function __construct($baseUrl, $file)
    {
        $this->setBaseUrl($baseUrl);
        $this->file = $file;
        $this->addCommand(['req' => $this->getRequestType()]);
    }

    public function getRequestType()
    {
        return 'imageprops';
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