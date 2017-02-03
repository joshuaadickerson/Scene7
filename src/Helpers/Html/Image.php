<?php

namespace Scene7\Helpers\Html;

class Image extends AbstractTag
{
    public function __construct(array $attributes = [])
    {
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
        return '<img' . $this->renderAttributes() . '>';
    }
}