<?php

namespace Scene7\Commands\Layer;

trait Grow
{
    public function setGrow($radius)
    {
        $radius = (int) $radius;

        if ($radius < -100 || $radius > 100) {
            throw new \InvalidArgumentException('Radius must be between -100 and 100');
        }

        $this->addCommand(['op_grow' => $radius]);
        return $this;
    }
}