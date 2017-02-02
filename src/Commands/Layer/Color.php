<?php

namespace Scene7\Commands\Layer;

trait Color
{
    public function setColorBalance($color)
    {
        $this->addCommand(['color' => $color]);
        return $this;
    }
}