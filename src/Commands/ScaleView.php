<?php

namespace Scene7\Commands;

trait ScaleView
{
    /**
     * @param float $factor
     * @return $this
     */
    public function setScaleView($factor)
    {
        $factor = (float) $factor;
        if ($factor < 0) {
            throw new \InvalidArgumentException('Factor must be greater than 0');
        }

        $this->addCommand(['scl' => $factor]);
        return $this;
    }
}