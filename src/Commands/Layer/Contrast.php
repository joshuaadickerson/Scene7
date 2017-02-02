<?php

namespace Scene7\Commands\Layer;

trait Contrast
{
    public function setContrast($adjustment)
    {
        $adjustment = (int) $adjustment;

        if ($adjustment < -100 || $adjustment > 100) {
            throw new \InvalidArgumentException('Adjustment must be between -100 and 100');
        }

        $this->addCommand(['op_contrast' => $adjustment]);
        return $this;
    }
}