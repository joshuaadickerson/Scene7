<?php

namespace Scene7\Requests;

class Message extends AbstractRequest
{
    use \Scene7\Commands\Message;

    /**
     * @param string $baseUrl
     * @param string $file
     * @param string $message
     */
    public function __construct($baseUrl, $file, $message)
    {
        $this->setBaseUrl($baseUrl);
        $this->file = $file;
        $this->setMessage($message);
    }

    public function getRequestType()
    {
        return 'message';
    }
}