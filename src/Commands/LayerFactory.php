<?php

namespace Scene7\Commands;

use Scene7\Factory;

trait LayerFactory
{
    /** @var Layer */
    protected $layers = [];
    /** @var string[] */
    protected $layerNameMap = [];

    /**
     * @param int|string|null $id
     * @param string|null $name
     * @return Layer
     */
    public function newLayer($id = null, $name = null)
    {
        if (!($this->factory instanceof Factory)) {
            throw new \RuntimeException('Factory not set');
        }

        if ($id === null) {
            $id = $this->getMaxLayer() + 1;
        }

        $layer = $this->factory->newLayer($id, $name);
        $this->addLayer($layer);
        return $layer;
    }

    public function addLayer(Layer $layer)
    {
        $this->layers[$layer->getId()] = $layer;
        return $this;
    }

    /**
     * @return int|string
     */
    public function getMaxLayer()
    {
        return empty($this->layers) ? 0 : max(array_keys($this->layers));
    }

    /**
     * @param int|string $id
     * @return Layer
     */
    public function getLayer($id)
    {
        return isset($this->layers[$id]) ? $this->layers[$id] : $this->newLayer($id);
    }

    /**
     * @param string $name
     * @return Layer
     */
    public function getLayerByName($name)
    {
        return isset($this->layerNameMap[$name]) ? $this->layers[$this->layerNameMap[$name]] : $this->newLayer(null, $this->layerNameMap[$name]);
    }

    /**
     * @param bool $obscure
     * @return string
     */
    public function renderLayers($obscure = false)
    {
        $layers = '';

        foreach ($this->layers as $layer) {
            $layers .= '&' . $layer;
        }

        return $layers;
    }

    /**
     * @param bool $obscure
     * @return string
     */
    public function getQuery($obscure = false)
    {
        // @todo this doesn't work
        if ($obscure) {
            $query = parent::getQuery();
        } else {
            $query = parent::getQuery();
            $query .= $this->renderLayers();
        }

        return $query;
    }
}