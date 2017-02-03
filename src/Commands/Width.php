<?php

namespace Scene7\Commands;

trait Width
{
    public function setWidth($width)
    {
        $width = (int) $width;
        if ($width < 1) {
            throw new \InvalidArgumentException('Width must be an integer greater than 0');
        }

        $this->addCommand(['wid' => $width]);
        return $this;
    }

    public function getWidth()
    {
        return isset($this->commands['wid']) ? $this->commands['wid'] : null;
    }
}