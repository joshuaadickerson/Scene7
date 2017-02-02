<?php

namespace Scene7\Commands\Layer;

trait Invert
{
    public function setInvert($invert)
    {
        $this->addCommand(['op_invert' => (int) (bool) $invert]);
        return $this;
    }
}