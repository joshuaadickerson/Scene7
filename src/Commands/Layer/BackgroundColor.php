<?php

namespace Scene7\Commands\Layer;

trait BackgroundColor
{
    public function setBackgroundColor($color)
    {
        $this->addCommand(array('bgColor' => $color));
    }
}