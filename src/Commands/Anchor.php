<?php

namespace Scene7\Commands;

trait Anchor
{
    public function setAnchor($x, $y, $normalized = false)
    {
        if ($normalized) {
            $this->setAnchorNormalized($x, $y);
        } else {
            $x = (int) $x;
            $y = (int) $y;

            $this->addCommand(array('anchor' => $x . ',' . $y));
        }

        return $this;
    }

    public function setAnchorNormalized($x, $y)
    {
        $x = (float) $x;
        $y = (float) $y;

        $this->addCommand(array('anchorN' => $x . ',' . $y));
        return $this;
    }
}