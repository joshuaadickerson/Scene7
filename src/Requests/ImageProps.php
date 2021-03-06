<?php

namespace Scene7\Requests;

use Scene7\Commands;
use Scene7\Definitions\ResponseTypes;

class ImageProps extends AbstractRequest
{
    use Commands\ResponseType,
        Commands\Id;

    /**
     * @param string $baseUrl
     * @param string $file
     * @param string $responseType
     */
    public function __construct($baseUrl, $file, $responseType = '')
    {
        $this->setBaseUrl($baseUrl);
        $this->file = $file;
        $this->setResponseType($responseType);
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