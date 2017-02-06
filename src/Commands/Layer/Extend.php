<?php

namespace Scene7\Commands\Layer;

trait Extend
{
    /**
     * @param int|float $left
     * @param int|float $top
     * @param int|float $right
     * @param int|float $bottom
     * @param bool $normalized
     * @return $this
     */
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

    /**
     * @param float $left
     * @param float $top
     * @param float $right
     * @param float $bottom
     * @return $this
     */
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