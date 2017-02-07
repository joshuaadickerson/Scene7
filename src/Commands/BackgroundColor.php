<?php

namespace Scene7\Commands;

use Scene7\Requests\AbstractRequest;

trait BackgroundColor
{
    /**
     * @param string $color
     * @return AbstractRequest
     */
    public function setBackgroundColor($color)
    {
        return $this->addCommand(['bgc' => $color]);
    }
}