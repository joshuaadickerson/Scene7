<?php

namespace Scene7\Requests;

use Scene7\Commands;
use Scene7\Definitions\ResponseTypes;
use Scene7\Definitions\Encodings;

class ImageSet extends AbstractRequest
{
    use Commands\ResponseType,
        Commands\Id;

    public function __construct($baseUrl, $file, $responseType = '', $encoding = '')
    {
        $this->setBaseUrl($baseUrl);
        $this->file = $file;
        $this->setResponseType($responseType);
        $this->setEncoding($encoding);
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

    public function getAllowedEncodings()
    {
        return [
            Encodings::ISO_8859_1,
            Encodings::UTF_8,
            Encodings::UTF_16,
            Encodings::UTF_16LE,
            Encodings::UTF_16BE,
        ];
    }
}