<?php

namespace Scene7\Commands;

trait LayerFactory
{
    protected $layers = [];
    protected $layerNameMap = [];

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

    public function getMaxLayer()
    {
        return max(array_keys($this->layers));
    }

    public function getLayer($id)
    {
        return isset($this->layers[$id]) ? $this->layers[$id] : $this->newLayer($id);
    }

    public function getLayerByName($name)
    {
        return isset($this->layerNameMap[$name]) ? $this->layers[$this->layerNameMap[$name]] : $this->newLayer(null, $this->layerNameMap[$name]);
    }

    /*
 * To implement
 * bgColor
 * blendmode
 * clipPath
 * clipXPath
 * color
 * effect
 * extend
 * flip
 * hide
 * layer
 * map
 * mask
 * maskUse
 * op_blur
 * op_brightness
 * op_colorbalance
 * op_colorize
 * op_contrast
 * op_grow
 * op_hue
 * op_invert
 * op_noise
 * op_saturation
 * op_sharpen
 * op_usm
 * opac
 * origin
 * pathAttr
 * perspective
 * pos
 * rotate
 * size
 * src
 * text
 * textAngle
 * textAttr
 * textFlowPath
 * textFlowXPath
 * textPath
 * textPs
 *
 */
}