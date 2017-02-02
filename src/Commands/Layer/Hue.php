<?php

namespace Scene7\Commands\Layer;

trait Hue
{
    public function setHue($adjustment)
    {
        $adjustment = (int) $adjustment;

        if ($adjustment < -180 || $adjustment > 180) {
            throw new \InvalidArgumentException('Adjustment must be between -180 and 180');
        }

        $this->addCommand(['op_hue' => $adjustment]);
        return $this;
    }
}