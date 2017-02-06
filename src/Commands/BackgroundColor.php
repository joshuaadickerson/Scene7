<?php

namespace Scene7\Commands;

trait BackgroundColor
{
    /**
     * @param string $color
     * @return $this
     */
    public function setBackgroundColor($color)
    {
        $this->addCommand(['bgc' => $color]);
        return $this;
    }
}