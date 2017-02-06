<?php

namespace Scene7\Helpers\Html;

use Scene7\Helpers\Html\Attributes\Srcset;
use Scene7\Helpers\ImageMultiplier;
use Scene7\Requests;

class Source extends AbstractTag
{
    use ImageMultiplier;

    public function __construct(array $attributes = [])
    {
        $this->setAttributes($attributes);
    }

    public function createFromImage(Requests\Image $image, array $multipliers = [])
    {
        return $this->setSrcset(new Srcset($image->render(), $image, $multipliers));
    }

    /**
     * @param string $srcset
     * @return $this
     */
    public function setSrcset($srcset)
    {
        return $this->setAttribute('srcset', $srcset);
    }

    /**
     * @param string $src
     * @return $this
     */
    public function setSrc($src)
    {
        return $this->setAttribute('src', $src);
    }

    /**
     * @param string $type
     * @return $this
     */
    public function setType($type)
    {
        return $this->setAttribute('type', $type);
    }

    /**
     * @param string $media
     * @return $this
     */
    public function setMedia($media)
    {
        return $this->setAttribute('media', $media);
    }

    public function render()
    {
        if (!$this->hasAttribute('src') && !$this->hasAttribute('srcset')) {
            throw new \RuntimeException('Source must contain a src or srcset attribute');
        }

        return '<source' . $this->renderAttributes() . '>';
    }
}