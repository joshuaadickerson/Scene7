<?php

namespace Scene7\Commands;

trait Crop
{
    /**
     * @param int|float $coordX
     * @param int|float $coordY
     * @param int|float $sizeX
     * @param int|float $sizeY
     * @param bool $normalized
     * @return $this
     */
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

    /**
     * @param int $coordX
     * @param int $coordY
     * @param int $sizeX
     * @param int $sizeY
     * @return $this
     */
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