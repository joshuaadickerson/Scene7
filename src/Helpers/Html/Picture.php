<?php

namespace Scene7\Helpers\Html;

use Scene7\Requests;

class Picture extends AbstractTag
{
    protected $image;
    protected $sources = [];

    public function __construct(array $attributes = [])
    {
        $this->setAttributes($attributes);
    }

    protected function addSourceFromImage(Requests\Image $image, $multipliers = [], array $attributes = [])
    {
        $source = new Source($attributes);
        $source->createFromImage($image, $multipliers);
        return $this->addSource($source);
    }

    public function setImage($image, array $attributes = [])
    {
        if (!($image instanceof $image)) {
            $image = new Image($image, $attributes['alt'] ?: '', $attributes);
        }

        $this->image = $image;
        return $this;
    }

    public function addSource(Source $source)
    {
        $this->sources[] = $source;
        return $this;
    }

    public function render()
    {
        $tag = '<picture' . $this->renderAttributes() . '>';

        $tag .= $this->renderSources();
        $tag .= $this->renderImage();

        return $tag . '</picture>';
    }

    protected function renderSources()
    {
        $sources = '';
        foreach ($this->sources as $source) {
            $sources .= $source->render();
        }

        return $sources;
    }

    protected function renderImage()
    {
        if (!($this->image instanceof Image)) {
            throw new \RuntimeException('No image set');
        }

        return $this->image->render();
    }

    public function __toString()
    {
        return $this->render();
    }
}