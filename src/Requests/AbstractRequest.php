<?php

namespace Scene7\Requests;

use Scene7\Factory;
use Scene7\RenderInterface;

abstract class AbstractRequest implements RenderInterface
{
    protected $baseUrl;
    protected $file;
    protected $commands = array();
    protected $factory;
    protected $protocol;

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

    public function getCommands()
    {
        return $this->commands;
    }

    public function getQuery($obscure = false)
    {
        if ($obscure) {
            $query = $this->getObscuredQuery();
        } else {
            $query = urldecode(http_build_query($this->commands));
        }

        return $query;
    }

    // @todo broken
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

        return base64_encode(urldecode(http_build_query($commands)));
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

    public function getUri($obscure = false)
    {
        return ($this->protocol ?: '') . $this->baseUrl . $this->file . '?' . $this->getQuery($obscure);
    }

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
}