<?php

namespace Scene7\Commands\Layer;

trait Position
{
    public function setPosition($x, $y, $normalized = false)
    {
        if ($normalized) {
            $x = (float) $x;
            $y = (float) $y;
            $this->addCommand(['posN' => $x . ',' . $y]);
        } else {
            $x = (int) $x;
            $y = (int) $y;
            $this->addCommand(['pos' => $x . ',' . $y]);
        }

        return $this;
    }

    public function setPositionNormalized($x, $y)
    {
        return $this->setPosition($x, $y, true);
    }
}