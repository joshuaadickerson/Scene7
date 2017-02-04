<?php

namespace Scene7\Commands;

trait BackgroundColor
{
    public function setBackgroundColor($color)
    {
        $this->addCommand(['bgc' => $color]);
        return $this;
    }
}