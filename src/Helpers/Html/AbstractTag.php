<?php

namespace Scene7\Helpers\Html;

use Scene7\RenderInterface;

abstract class AbstractTag implements RenderInterface
{
    /** @var string[] */
    protected $attributes = [];

    /**
     * @return string
     */
    abstract public function render();

    /**
     * @param string $id
     * @return AbstractTag
     */
    public function setId($id)
    {
        return $this->setAttribute('id', $id);
    }

    /**
     * @param string|array $class
     * @return AbstractTag
     */
    public function setClass($class)
    {
        return $this->setAttribute('class', is_array($class) ? implode(' ', $class) : $class);
    }

    /**
     * @param string|array $style
     * @return AbstractTag
     */
    public function setStyle($style)
    {
        return $this->setAttribute('style', is_array($style) ? implode('; ', $style) : $style);
    }

    /**
     * @param string $title
     * @return AbstractTag
     */
    public function setTitle($title)
    {
        return $this->setAttribute('title', $title);
    }

    /**
     * @param array $attributes
     * @return $this
     */
    public function setAttributes(array $attributes)
    {
        foreach ($attributes as $attribute => $value) {
            $this->setAttribute($attribute, $value);
        }

        return $this;
    }

    /**
     * @param string $attribute
     * @param string $value
     * @return $this
     */
    public function setAttribute($attribute, $value)
    {
        $this->attributes[$attribute] = $value;
        return $this;
    }

    /**
     * @return string[]
     */
    public function getAttributes()
    {
        return $this->attributes;
    }

    /**
     * @param string $attribute
     * @return bool
     */
    public function hasAttribute($attribute)
    {
        return isset($this->attributes[$attribute]) && $this->attributes[$attribute] !== '';
    }

    /**
     * @return string
     */
    protected function renderAttributes()
    {
        $rendered = '';
        foreach ($this->getAttributes() as $attributeKey => $attribute) {
            if ($attribute instanceof RenderInterface) {
                $attribute = $attribute->render();
            }

            if (!is_string($attribute)) {
                throw new \RuntimeException('Cannot render attribute: ' . $attributeKey);
            }

            $rendered .= ' ' . $attributeKey . '="' . strtr($attribute, '"', '\\"') . '"';
        }

        return $rendered;
    }

    /**
     * @return string
     */
    public function __toString()
    {
        return $this->render();
    }
}