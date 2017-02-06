<?php

namespace Scene7\Commands\Layer;

trait BackgroundColor
{
    /**
     * @param string $color
     */
    public function setBackgroundColor($color)
    {
        $this->addCommand(array('bgColor' => $color));
    }
}