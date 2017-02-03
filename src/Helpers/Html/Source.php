<?php

namespace Scene7\Helpers\Html;

use Scene7\Helpers\Html\Attributes\Srcset;
use Scene7\Helpers\ImageMultiplier;
use Scene7\Requests\Image;

class Source extends AbstractTag
{
    use ImageMultiplier;

    public function __construct(array $attributes = [])
    {
        $this->setAttributes($attributes);
    }

    public function createFromImage(Image $image, array $multipliers = [])
    {
        return $this->setSrcset(new Srcset($image->render(), $image, $multipliers));
    }

    public function setSrcset($srcset)
    {
        return $this->setAttribute('srcset', $srcset);
    }

    public function setSrc($src)
    {
        return $this->setAttribute('src', $src);
    }

    public function setType($type)
    {
        return $this->setAttribute('type', $type);
    }

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