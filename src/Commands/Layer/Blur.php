<?php

namespace Scene7\Commands\Layer;

trait Blur
{
    /**
     * @param float $radius
     * @return $this
     */
    public function setBlur($radius)
    {
        $radius = (float) $radius;
        if ($radius < 0 || $radius > 100) {
            throw new \InvalidArgumentException('Radius must be between 0 and 100');
        }

        $this->addCommand(['op_blur' => $radius]);
        return $this;
    }
}