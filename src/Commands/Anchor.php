<?php

namespace Scene7\Commands;

trait Anchor
{
    /**
     * @param int|float $x
     * @param int|float $y
     * @param bool|false $normalized
     * @return $this
     */
    public function setAnchor($x, $y, $normalized = false)
    {
        if ($normalized) {
            $this->setAnchorNormalized($x, $y);
        } else {
            $x = (int) $x;
            $y = (int) $y;

            $this->addCommand(['anchor' => $x . ',' . $y]);
        }

        return $this;
    }

    /**
     * @param float $x
     * @param float $y
     * @return $this
     */
    public function setAnchorNormalized($x, $y)
    {
        $x = (float) $x;
        $y = (float) $y;

        $this->addCommand(['anchorN' => $x . ',' . $y]);
        return $this;
    }
}