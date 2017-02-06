<?php

namespace Scene7\Commands;

trait RegionOfInterest
{
    /**
     * @param int $coordX
     * @param int $coordY
     * @param int $sizeX
     * @param int $sizeY
     * @return $this
     */
    public function setRegionOfInterest($coordX, $coordY, $sizeX, $sizeY)
    {
        $coordX = (int) $coordX;
        $coordY = (int) $coordY;
        $sizeX  = (int) $sizeX;
        $sizeY  = (int) $sizeY;

        $this->addCommand(['rgn' => $coordX . ',' . $coordY . ',' . $sizeX . ',' . $sizeY]);
        return $this;
    }
}