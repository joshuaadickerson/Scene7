<?php

namespace Scene7\Commands\Layer;

trait Size
{
    public function setSize($width, $height, $normalized = false)
    {
        if ($normalized) {
            $width  = (float) $width;
            $height = (float) $height;
            $this->addCommand(['sizeN' => $width . ',' . $height]);
        } else {
            $width  = (int) $width;
            $height = (int) $height;
            $this->addCommand(['size' => $width . ',' . $height]);
        }

        return $this;
    }

    public function setSizeNormalized($width, $height)
    {
        return $this->setSize($width, $height, true);
    }
}