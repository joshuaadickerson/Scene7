<?php

namespace Scene7\Commands\Layer;

trait Origin
{
    public function setOrigin($x, $y, $normalized = false)
    {
        if ($normalized) {
            $this->setAnchorNormalized($x, $y);
        } else {
            $x = (int) $x;
            $y = (int) $y;

            $this->addCommand(array('origin' => $x . ',' . $y));
        }

        return $this;
    }

    public function setOriginNormalized($x, $y)
    {
        $x = (float) $x;
        $y = (float) $y;

        $this->addCommand(array('originN' => $x . ',' . $y));
        return $this;
    }
}