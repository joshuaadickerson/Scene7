<?php

namespace Scene7\Commands;

trait BackgroundColor
{
    public function setBackgroundColor($color)
    {
        $this->addCommand(array('bgc' => $color));
        return $this;
    }
}