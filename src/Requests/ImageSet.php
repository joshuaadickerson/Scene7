<?php

namespace Scene7\Requests;

use Scene7\Commands;

class ImageSet extends AbstractRequest
{
    use Commands\ResponseType,
        Commands\Id;

    const ALLOWED_RESPONSE_TYPES = ['text', 'javascript', 'xml', 'json'];
    const ALLOWED_ENCODINGS = ['UTF-8', 'UTF-16', 'UTF-16LE', 'UTF-16BE', 'ISO-8859-1'];

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
}