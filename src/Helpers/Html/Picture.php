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

    public function addSourceFromImage(Requests\Image $image, $multipliers = [], array $attributes = [])
    {
        $source = new Source($attributes);
        $source->createFromImage($image, $multipliers);
        return $this->addSource($source);
    }

    /**
     * Add all of the sources with a single call.
     *
     * This looks complicated, but the goal is merely to reduce the amount of code you have to write
     *
     * @param array $mediaQueries
     * @param Requests\Image $image
     * @param array $multipliers
     * @param array $attributes
     * @return $this
     */
    public function addSourceListFromImage(array $mediaQueries, Requests\Image $image, $multipliers = [], array $attributes = [])
    {
        foreach ($mediaQueries as $query => $imageAttributes) {
            // Set the image to match the query
            $cloneImg = clone $image;
            foreach ($imageAttributes as $imageAttribute => $imageAttributeValue) {
                $method = 'set' . ucfirst($imageAttribute);
                if (is_callable([$cloneImg, $method])) {
                    $cloneImg->$method($imageAttributeValue);
                }
            }

            $this->addSourceFromImage($cloneImg, $multipliers, array_merge($attributes, ['media' => $query]));
        }

        return $this;
    }

    public function setImage($image, array $attributes = [])
    {
        if (!($image instanceof Image)) {
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