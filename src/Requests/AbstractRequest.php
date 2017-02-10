<?php

namespace Scene7\Requests;

use Scene7\Factory;
use Scene7\RenderInterface;

abstract class AbstractRequest implements RenderInterface
{
    /** @var string */
    protected $baseUrl = '';
    /** @var string */
    protected $file = '';
    /** @var array */
    protected $commands = [];
    /** @var Factory */
    protected $factory;
    /** @var string */
    protected $protocol = '';
    /** @var string */
    protected $responseType = '';
    /** @var string */
    protected $encoding = '';

    /**
     * @return string
     */
    abstract public function getRequestType();

    protected function setBaseUrl($baseUrl)
    {
        $this->baseUrl = $baseUrl;
        return $this;
    }

    protected function addCommand(array $commands)
    {
        $this->commands = array_merge($this->commands, $commands);
        return $this;
    }

    /**
     * @return array
     */
    public function getCommands()
    {
        return $this->commands;
    }

    /**
     * @param bool $obscure
     * @return string
     */
    public function getQuery($obscure = false)
    {
        if ($obscure) {
            $query = $this->getObscuredQuery();
        } else {
            $query = http_build_query($this->commands);
        }

        return $query;
    }

    /**
     * @todo broken
     * @return string
     */
    public function getObscuredQuery()
    {
        $commands = [];
        foreach ($this->commands as $k => $v) {
            $commands[$k] = strtr($v, [
                '=' => '%3D',
                '&' => '%26',
                '%' => '%25',
            ]);
        }

        return base64_encode(urldecode(http_build_query($commands)) . $this->renderLayers(true));
    }

    /**
     * A wrapper for getUri()
     *
     * @param bool $obscure
     * @return string
     */
    public function render($obscure = false)
    {
        return $this->getUri($obscure);
    }

    /**
     * @param bool $obscure
     * @return string
     */
    public function getUri($obscure = false)
    {
        return ($this->protocol ?: '')
            . $this->baseUrl
            . $this->file
            . '?'
            . $this->renderRequestType()
            . $this->getQuery($obscure);
    }

    /**
     * @return string
     */
    protected function renderRequestType()
    {
        $requestType = $this->getRequestType();

        if ($requestType !== 'img' && !empty($requestType)) {
            $requestType = 'req=' . $requestType . '&';

            if (!empty($this->responseType) || !empty($this->encoding)) {
                $requestType .= ',' . $this->responseType;
            }

            if (!empty($this->encoding)) {
                $requestType .= ',' . $this->encoding;
            }
        } else {
            $requestType = '';
        }

        return $requestType;
    }

    /**
     * @param string $protocol
     * @return $this
     */
    public function setProtocol($protocol)
    {
        $this->protocol = $protocol;
        return $this;
    }

    public function __toString()
    {
        return $this->getUri();
    }

    public function setFactory(Factory $factory)
    {
        $this->factory = $factory;
        return $this;
    }

    /**
     * @return string[]
     */
    public function getAllowedResponseTypes()
    {
        return [];
    }

    /**
     * @return string[]
     */
    public function getAllowedEncodings()
    {
        return [];
    }
}