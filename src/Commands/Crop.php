<?php

namespace Scene7\Commands;

trait Crop
{
    public function setCrop($coordX, $coordY, $sizeX, $sizeY, $normalized = false)
    {
        if ($normalized) {
            $this->setCropNormalized($coordX, $coordY, $sizeX, $sizeY);
        } else {
            $coordX = (int) $coordX;
            $coordY = (int) $coordY;
            $sizeX = (int) $sizeX;
            $sizeY = (int) $sizeY;

            $this->addCommand(['crop' => $coordX . ',' . $coordY . ',' . $sizeX . ',' . $sizeY]);
        }

        return $this;
    }

    public function setCropNormalized($coordX, $coordY, $sizeX, $sizeY)
    {
        $coordX = (float) $coordX;
        $coordY = (float) $coordY;
        $sizeX = (float) $sizeX;
        $sizeY = (float) $sizeY;

        $this->addCommand(['cropN' => $coordX . ',' . $coordY . ',' . $sizeX . ',' . $sizeY]);
        return $this;
    }
}