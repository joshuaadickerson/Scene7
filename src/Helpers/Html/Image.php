<?php

namespace Scene7\Helpers\Html;

class Image extends AbstractTag
{
    public function __construct($src, $alt, array $attributes = [])
    {
        $this->setSrc($src);
        $this->setAlt($alt);
        $this->setAttributes($attributes);
    }

    public function setSrc($src)
    {
        return $this->setAttribute('src', $src);
    }

    public function setSrcset($srcset)
    {
        return $this->setAttribute('srcset', $srcset);
    }

    public function setAlt($text)
    {
        return $this->setAttribute('alt', $text);
    }

    public function render()
    {
        if (!isset($this->attributes['src']) || !isset($this->attributes['alt'])) {
            throw new \InvalidRuntimeException('Image requires src and alt attributes');
        }

        return '<img' . $this->renderAttributes() . '>';
    }
}