<?php

namespace Scene7\Helpers\Html;

use Scene7\RenderInterface;

abstract class AbstractTag implements RenderInterface
{
    protected $attributes = [];

    abstract public function render();

    public function setId($id)
    {
        return $this->setAttribute('id', $id);
    }

    public function setClass($class)
    {
        return $this->setAttribute('class', $class);
    }

    public function setStyle($style)
    {
        return $this->setAttribute('style', $style);
    }

    public function setTitle($title)
    {
        return $this->setAttribute('title', $title);
    }

    public function setAttributes(array $attributes)
    {
        foreach ($attributes as $attribute => $value) {
            $this->setAttribute($attribute, $value);
        }

        return $this;
    }

    public function setAttribute($attribute, $value)
    {
        $this->attributes[$attribute] = $value;
        return $this;
    }

    public function getAttributes()
    {
        return $this->attributes;
    }

    public function hasAttribute($attribute)
    {
        return isset($this->attributes[$attribute]) && $this->attributes[$attribute] !== '';
    }

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

    public function __toString()
    {
        return $this->render();
    }
}