<?php

namespace Scene7;

use Scene7\Commands\Layer;
use Scene7\Requests\AbstractRequest;

class Factory
{
    protected $baseUrl;
    protected $defaultsCallback;
    protected $layerDefaultsCallback;

    /**
     * @param string $baseUrl the base url
     * @param callable|null $defaultsCallback has one parameter, $request that is the request object
     */
    public function __construct($baseUrl, callable $defaultsCallback = null)
    {
        $this->setBaseUrl($baseUrl);

        if (is_callable($defaultsCallback)) {
            $this->setDefaultsCallback($defaultsCallback);
        }
    }

    public function newImage($file)
    {
        $image = new Requests\Image($this->baseUrl, $file);
        $image->setFactory($this);
        $this->_setNewRequestDefaults($image);

        return $image;
    }

    public function newLayer($id, $name = null)
    {
        $layer = new Layer($id, $name);
        $this->_setNewLayerDefaults($layer);
        return $layer;
    }

    public function setBaseUrl($baseUrl)
    {
        if ($baseUrl[strlen($baseUrl)-1] !== '/') {
            $baseUrl .= '/';
        }

        $this->baseUrl = $baseUrl;
        return $this;
    }

    public function setProtocol($protocol)
    {
        $this->protocol = $protocol;
        return $this;
    }

    public function setDefaultsCallback(callable $callback)
    {
        $this->defaultsCallback = $callback;
        return $this;
    }

    protected function _setNewRequestDefaults(AbstractRequest $request)
    {
        if (is_callable($this->defaultsCallback)) {
            $callback = $this->defaultsCallback;
            $callback($request);
        }

        return $this;
    }

    protected function _setNewLayerDefaults(Layer $layer)
    {
        if (is_callable($this->layerDefaultsCallback)) {
            $callback = $this->defaultsCallback;
            $callback($layer);
        }

        return $this;
    }
}