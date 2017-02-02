<?php

namespace Scene7\Commands\Layer;

trait Extend
{
    public function setExtend($left, $top, $right, $bottom, $normalized = false)
    {
        if ($normalized) {
            $this->setExtendNormalized($left, $top, $right, $bottom);
        } else {
            $left   = (int) $left;
            $top    = (int) $top;
            $right  = (int) $right;
            $bottom = (int) $bottom;

            $this->addCommand(['extend' => $left . ',' . $top . ',' . $right . ',' . $bottom]);
        }

        return $this;
    }

    public function setExtendNormalized($left, $top, $right, $bottom)
    {
        $left   = (float) $left;
        $top    = (float) $top;
        $right  = (float) $right;
        $bottom = (float) $bottom;

        $this->addCommand(['extendN' => $left . ',' . $top . ',' . $right . ',' . $bottom]);
        return $this;
    }
}