<?php

namespace Scene7\Helpers\Html;

class Image extends AbstractTag
{
    /**
     * @param string $src
     * @param string $alt
     * @param array $attributes
     */
    public function __construct($src, $alt, array $attributes = [])
    {
        $this->setSrc($src);
        $this->setAlt($alt);
        $this->setAttributes($attributes);
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
     * @param string $srcset
     * @return $this
     */
    public function setSrcset($srcset)
    {
        return $this->setAttribute('srcset', $srcset);
    }

    /**
     * @param string $text
     * @return $this
     */
    public function setAlt($text)
    {
        return $this->setAttribute('alt', $text);
    }

    public function render()
    {
        if (!isset($this->attributes['src']) || !isset($this->attributes['alt'])) {
            throw new \RuntimeException('Image requires src and alt attributes');
        }

        return '<img' . $this->renderAttributes() . '>';
    }
}