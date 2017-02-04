<?php

namespace Scene7\Commands\Layer;

trait Color
{
    public function setColor($color)
    {
        $this->addCommand(['color' => $color]);
        return $this;
    }
}