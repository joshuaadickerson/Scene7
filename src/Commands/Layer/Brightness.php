<?php

namespace Scene7\Commands\Layer;

trait Brightness
{
    /**
     * @param int $adjustment
     * @return $this
     */
    public function setBrightness($adjustment)
    {
        $adjustment = (int) $adjustment;
        if ($adjustment < -100 || $adjustment > 100) {
            throw new \InvalidArgumentException('Brightness must be between -100 and 100');
        }

        $this->addCommand(['op_brightness' => $adjustment]);
        return $this;
    }
}