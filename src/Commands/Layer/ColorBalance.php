<?php

namespace Scene7\Commands\Layer;

trait ColorBalance
{
    public function setColorBalance($red, $green, $blue)
    {
        $red    = (int) $red;
        $green  = (int) $green;
        $blue   = (int) $blue;

        if ($red < -100 || $red > 100) {
            throw new \InvalidArgumentException('Red adjustment must be between -100 and 100');
        }

        if ($green < -100 || $green > 100) {
            throw new \InvalidArgumentException('Green adjustment must be between -100 and 100');
        }

        if ($blue < -100 || $blue > 100) {
            throw new \InvalidArgumentException('Blue adjustment must be between -100 and 100');
        }

        $this->addCommand(['op_colorbalance' => $red . ',' . $green . ',' . $blue]);
        return $this;
    }
}