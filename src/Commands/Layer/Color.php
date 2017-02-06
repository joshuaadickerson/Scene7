<?php

namespace Scene7\Commands\Layer;

trait Color
{
    /**
     * @param string $color
     * @return $this
     */
    public function setColor($color)
    {
        $this->addCommand(['color' => $color]);
        return $this;
    }
}