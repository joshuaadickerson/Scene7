<?php

namespace Scene7\Commands;

trait ScaleView
{
    public function setScaleView($factor)
    {
        $factor = (float) $factor;
        if ($factor < 0) {
            throw new \InvalidArgumentException('Factor must be greater than 0');
        }

        $this->addCommand(array('scl' => $factor));
        return $this;
    }
}